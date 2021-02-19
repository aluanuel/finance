<?php

namespace App\Http\Controllers;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\LoanRepayment;

class LoanRepaymentController extends Controller {

	public function index() {

		$loans = DB::table('loan_applications')
			->where('loan_status', '=', 'started')
			->where('end_date', '>=', Carbon::now())
			->select('id', 'loan_number')
			->orderBy('created_at', 'desc')
			->limit(500)
			->get();
		$id_loan = null;

		$pays = DB::table('loan_repayments')
			->join('loan_applications', 'loan_repayments.id_loan', 'loan_applications.id')
			->select('loan_applications.loan_number', 'loan_repayments.*')
			->orderBy('loan_repayments.created_at', 'desc')
			->limit(300)
			->get();

		$headers = 'Showing Recent Loan Payments';

		return view('apply.teller.trans.index', compact('loans', 'pays', 'headers','id_loan'));
	}

	public function showPayFormWithLoanSelected(Request $request) {

		$loans = DB::table('loan_applications')
			->where('loan_status', '=', 'started')
			->where('end_date', '>=', Carbon::now()->toDateString())
			->where('id', '=', $request->id)
			->select('id', 'loan_number')
			->orderBy('created_at', 'desc')
			->get();

		$id_loan = $request->id;

		$pays = DB::table('loan_repayments')
			->join('loan_applications', 'loan_repayments.id_loan', 'loan_applications.id')
			->select('loan_applications.loan_number', 'loan_repayments.*')
			->orderBy('loan_repayments.created_at', 'desc')
			->limit(300)
			->get();

		$headers = 'Showing Recent Loan Payments';

		if (sizeof($loans) < 1) {
			return redirect()->back()->with('error', 'Loan period expired, contact your loan officer for assistance');
		}
		return view('apply.teller.trans.index', compact('loans', 'pays', 'headers','id_loan'));
	}

	public function RecordPayment() {

		$app = LoanApplication::find(request('id_loan'));

		if ($app) {

			$loan = DB::table('loan_applications')
				->where('id', '=', request('id_loan'))
				->first();

			$total_loan = $loan->total_loan;

			$loan_recovered = $loan->loan_recovered;

			$balance = $total_loan - $loan_recovered;

			if ($balance < request('deposit')) {

				return redirect()->back()->with('warning', 'Deposit amount exceeds the loan balance of ' . number_format($balance));

			} else {

				$pay = new LoanRepayment();
				$pay->id_loan = request('id_loan');
				$pay->deposit = request('deposit');
				$pay->depositer = request('depositer');
				$pay->receipt_number = $this->Receipt();
				$pay->recorded_by = Auth::id();
				$pay->save();

				$new_recovery = $loan_recovered + request('deposit');

				$app->loan_recovered = $new_recovery;
				$app->loan_balance = ($total_loan - $new_recovery);

				if (($total_loan - $new_recovery) == 0) {

					$app->loan_status = 'completed';
				}
				$app->save();

				return redirect()->route('loanPaymentForm')->with('success', 'Transaction successful');
			}
		}
	}

	public function SearchPayment() {

		$start_date = Carbon::create(request('start_date'))->toDateTimeString();
		$end = Carbon::create(request('end_date'));

		$end_date = $end->addHours(23)->toDateTimeString();

		$pays = DB::table('loan_repayments')
			->join('loan_applications', 'loan_repayments.id_loan', 'loan_applications.id')
			->select('loan_applications.loan_number', 'loan_repayments.*')
			->whereBetween('loan_repayments.created_at', [$start_date, $end_date])
			->orderBy('loan_repayments.created_at', 'desc')
			->get();

		$loans = DB::table('loan_applications')
			->where('loan_status', '=', 'started')
			->where('end_date', '>=', Carbon::now())
			->select('id', 'loan_number')
			->orderBy('created_at', 'desc')
			->limit(500)
			->get();

		$headers = 'Showing Loan Payments Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

		return view('apply.teller.trans.index', compact('loans', 'pays', 'headers'));
	}

	protected function Receipt() {

		$id = LoanRepayment::latest('receipt_number')->first();

		if (is_null($id)) {

			return (10001);

		} else {

			return $id->receipt_number + 1;

		}
	}
}

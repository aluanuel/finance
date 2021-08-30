<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use \PDF;
use NumberToWords\NumberToWords;
use NumberToWords\Locale\English;
use Response;
use Illuminate\Support\Facades\Storage;
use \App\Models\LoanSecurity;

class PDFController extends Controller {

	public function CreateLoanPaymentReceipt(Request $request) {

		$numberToWords = new NumberToWords(new English()); // english

		$loan = DB::table('loan_repayments')
			->join('loan_applications', 'loan_repayments.id_loan', 'loan_applications.id')
			->select('loan_applications.loan_number', 'loan_repayments.*')
			->where('loan_repayments.id', '=', $request->id)
			->latest()
			->first();
		$amount = DB::table('loan_repayments')->select('deposit')->where('id','=',$request->id)->first();

		$amountInWords = $numberToWords->convert($amount->deposit);

		$data = ['title' => $loan];
		
		$pdf = PDF::loadView('apply.docs.receipts.loan_collections', compact('data','amountInWords'));

		return $pdf->download('PaymentReceipt.pdf');
	}
	public function CreateLoanApplicationReceipt(Request $request) {

		$numberToWords = new NumberToWords(new English()); // english

		$loan = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', 'register_clients.id')
			->select('register_clients.name', 'loan_applications.*')
			->where('loan_applications.id', '=', $request->id)
			->first();

		$amount = DB::table('loan_applications')->select('application_fee')->where('id','=',$request->id)->first();

		$amountInWords = $numberToWords->convert($amount->application_fee);

		$data = ['title' => $loan];

		$pdf = PDF::loadView('apply.docs.receipts.loan_application', compact('data','amountInWords'));

		return $pdf->download('ApplicationReceipt.pdf');
	}

	public function CreateAccountStatement(Request $request){
		$savings = DB::table('client_savings')
				->where('id_client',$request->id)
				->orderBy('created_at','asc')
				->get();
		$client = DB::table('register_clients')
				->where('id',$request->id)
				->first();
		$pdf = PDF::loadView('apply.docs.account.statement',compact('savings','client'));
		return $pdf->download('ac-statement'.$client->account.'.pdf');
	}

	public function CreateAccountsReport(){
		$accounts = DB::table('register_clients')
				->get();
		$pdf = PDF::loadView('apply.docs.account.accounts_list',compact('accounts'));
		return $pdf->download('accounts.pdf');
	}

	public function CreateCollectionsReport(){
		$pdf = PDF::loadView('apply.docs.reports.collections');
		return $pdf->download('collections.pdf');
	}

	public function CreateExpensesReport(){
		$expense = DB::table('other_payments')
				->where('payment_category','expense')
				->get();
		$pdf = PDF::loadView('apply.docs.reports.expenses',compact('expense'));
		return $pdf->download('expenses.pdf');
	}

	public function CreateIncomesReport(){
		$income = DB::table('other_payments')
				->where('payment_category','income')
				->get();
		$pdf = PDF::loadView('apply.docs.reports.incomes',compact('income'));
		return $pdf->download('incomes.pdf');
	}
	public function CreateCashBookReport(){
		$repayments = DB::table('loan_repayments')->orderBy('created_at','desc')->get();
        $appraisal = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->orderBy('created_at','desc')
                ->get();
        $application = DB::table('loan_applications')
                ->where('id_group', '=',null)
                ->orderBy('created_at','desc')
                ->get();
        $loan = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->where('loan_applications.loan_status', '!=',null)
                ->select('register_clients.name','loan_applications.*')
                ->orderBy('loan_applications.start_date','desc')
                ->get();
        $incomes = DB::table('other_payments')
                ->where('payment_category','income')
                ->orderBy('created_at')
                ->get();
        $expenses = DB::table('other_payments')
                ->where('payment_category','expense')
                ->orderBy('created_at')
                ->get();
		$pdf = PDF::loadView('apply.docs.reports.cashbook',compact('repayments','appraisal','application','loan','incomes','expenses'));
		return $pdf->download('cashbook.pdf');
	}

	public function ViewLoanSecurity(Request $request){

		$id = LoanSecurity::find($request->file);

		return Storage::download($id->security_attachment,$id->security_name);
		
	}
}

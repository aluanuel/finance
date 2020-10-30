<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\RegisterClient;
use Carbon\Carbon;

class LoanApplicationController extends Controller {

	public function viewIndividualApplication() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', '=', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.assessment_status','=',NULL)
			->where('loan_applications.id_group','=',NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		return view('apply.view.ind.index', compact('apps'));
	}

	public function continueIndividualApplication(Request $request) {

		$loan_id = $loan = LoanApplication::find($request->id);

		$cont = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation', 'register_clients.district', 'register_clients.resident_village', 'register_clients.resident_parish', 'register_clients.resident_division', 'register_clients.resident_district', 'register_clients.next_of_kin')
			->where('loan_applications.id', '=', $loan_id->id)
			->first();

		return view('apply.ind.cont.index', compact('cont'));
	}

	public function updateIndividualApplication(Request $request) {

		$loan = LoanApplication::find($request->id);
		// dd($loan->id_client);
		$id_client = RegisterClient::find($loan->id_client);

		if ($id_client) {

			$id_client->name = request('name');
			$id_client->telephone = request('telephone');
			$id_client->gender = request('gender');
			$id_client->marital_status = request('marital_status');
			$id_client->work_place = request('work_place');
			$id_client->occupation = request('occupation');
			$id_client->district = request('district');
			$id_client->resident_village = request('resident_village');
			$id_client->resident_parish = request('resident_parish');
			$id_client->resident_division = request('resident_division');
			$id_client->resident_district = request('resident_district');
			$id_client->next_of_kin = request('next_of_kin');
			$id_client->save();

			$loan->proposed_amount = request('proposed_amount');
			$loan->loan_period = request('loan_period');
			$loan->borrowing_purpose = request('borrowing_purpose');
			$loan->income_sources = request('income_sources');
			$loan->save();

			return redirect()->route('viewSingle')->with('success', 'Transaction successful');
		}
	}

	public function acceptLoan(Request $request) {

		$loan = LoanApplication::find($request->id);
		if ($loan) {
			$loan->approval_status = 1;
			$loan->save();
		}
		return redirect()->back()->with('success', 'Transaction successful');
	}

	public function viewIndividualProcessedLoans() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

		$running = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'started')->orderBy('loan_applications.created_at', 'desc')->get();
		$completed = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();

		return view('apply.view.ind.processed', compact('apps', 'running', 'completed'));
	}

	public function adminViewIndividualProcessedLoans() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

		$running = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'started')->orderBy('loan_applications.created_at', 'desc')->get();
		$completed = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();

		return view('apply.admin.ind.processed', compact('apps', 'running', 'completed'));
	}

	public function individualLoanPaymentSchedule(Request $request) {

		$schedule = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', 'register_clients.id')
			->select('register_clients.name', 'register_clients.telephone', 'register_clients.occupation', 'loan_applications.*')
			->where('loan_applications.id', '=', $request->id)
			->first();
		$instalment = DB::table('loan_schedules')
			->where('id_loan', '=', $request->id)
			->get();
		return view('apply.view.loan_schedule', compact('schedule', 'instalment'));

	}

	public function startIndividualProcessedLoans(Request $request) {

		$loan = LoanApplication::find($request->id);
		if ($loan) {
			$loan_period = request('loan_period');
			$today = Carbon::now();
			$loan->loan_status = 'started';
			$loan->start_date = $today->toDateString();
			$loan->end_date = $this->getEndDate($loan_period);
			$loan->issued_by = Auth::id();
			$loan->save();

			$today = $today->addDays(30);

			return redirect()->back()->with('success', 'Loan issued successfully');
		}
	}

	public function viewClientProfile(Request $request) {

		$loan = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.*')
			->where('loan_applications.id', '=', $request->id)
			->first();
		$ledger = DB::table('loan_repayments')
			->where('id_loan', '=', $request->id)
			->get();

		$history = DB::table('loan_applications')
			->where('id_client', '=', $this->getClientId($request->id)->id_client)
			->orderBy('created_at', 'desc')
			->get();

		return view('apply.view.client_profile', compact('loan', 'ledger', 'history'));
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function viewGroupApplication() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', '=', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.assessment_status','=',NULL)
			->where('loan_applications.id_group','!=',NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		return view('apply.view.grp.index', compact('apps'));
	}

	public function adminViewGroupProcessedLoans(){
		$apps = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('client_groups','client_groups.id','register_clients.id_group')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender','client_groups.group_code')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

		$running = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('client_groups','client_groups.id','register_clients.id_group')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender','client_groups.group_code')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'started')->orderBy('loan_applications.created_at', 'desc')->get();
		$completed = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('client_groups','client_groups.id','register_clients.id_group')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender','client_groups.group_code')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();
		return view('apply.admin.grp.processed',compact('apps', 'running', 'completed'));
	}









	protected function getEndDate($period) {

		$date = date('Y-m-d', strtotime('+' . $period . ' month'));

		return $date;
	}

	protected function getClientId($id) {

		return DB::table('loan_applications')
			->where('id', '=', $id)
			->select('id_client')
			->first();
	}
}

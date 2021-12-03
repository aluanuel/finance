<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\RegisterClient;
use Carbon\Carbon;
use App\Rules\ValidatePassword;
use \App\Models\LoanSchedule;
use \App\Models\ClientGroup;

class LoanApplicationController extends Controller {

	public function singleApplication() {

		if(Auth::user()->role == 'Supervisor'){

			$clients = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->join('users', 'loan_applications.application_by', 'users.id')
			->select('loan_applications.*','users.name as officer', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation')
			->where('register_clients.id_group',  NULL)
			->where('loan_applications.application_status',  '1')
			->where('loan_applications.proposed_amount',  NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		}else{

			$clients = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->join('users', 'loan_applications.application_by', 'users.id')
			->select('loan_applications.*','users.name as officer', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation')
			->where('register_clients.id_group',  NULL)
			->where('loan_applications.application_status', '1')
			->where('loan_applications.proposed_amount',  NULL)
			->where('loan_applications.application_by',Auth::user()->id)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		}

		$register = RegisterClient::where('id_group',NULL)
			->where('account_status',1)
			->get();

		$loan = $this->loanNumber();

		$interest = DB::table('interest_on_loans')
			->select('interest_rate')
			->where('loan_type', '=', 'Individual')
			->latest()
			->first();
		$application = DB::table('application_fees')
			->where('application_type','Individual')
			->select('application_amount')
			->latest()
			->first();	

		return view('apply.ind.index', compact('clients', 'loan', 'register', 'interest','application'));
	}

	public function NewIndividualApplication(Request $request) {

		$loanApp = new LoanApplication();

		$check = DB::table('loan_applications')
					->where('id_client',request('id_client'))
					->where('loan_status','!=','completed')
					->get();
			if(sizeof($check) > 0){
				return redirect()->route('viewLoanList',[request('id_client')])->with('error','You have '.sizeof($check). ' incomplete loan(s). Please complete the current running loan or resume the exisiting loan application');
			}else{

				$loanApp->id_client = request('id_client');

				$loanApp->application_fee = request('application_fee');

				$loanApp->application_date = Carbon::now()->toDateTimeString();

				$loanApp->loan_number = request('loan_number');

				$loanApp->interest_rate = request('interest_rate');

				$loanApp->application_by = Auth::id();

				$loanApp->save();

				return redirect()->back()->with('success', 'Loan Application Successful');
			}

	}

	public function showGroupApplicationForm(){

		$groups = ClientGroup::get();

		$loan = DB::table('loan_applications')
		->join('register_clients','loan_applications.id_client','register_clients.id')
		->join('client_groups','loan_applications.id_group','client_groups.id')
		->select('client_groups.group_name','client_groups.group_code','register_clients.name','register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation','loan_applications.*')
		->where('loan_applications.id_group','!=',NULL)
		->where('loan_applications.application_status',1)
		->where('loan_applications.assessment_status','=',NULL)
		->where('loan_applications.application_by',Auth::user()->id)
		->orderBy('loan_applications.created_at','desc')
		->get();

		$register = DB::table('register_clients')
			->join('client_groups','register_clients.id_group','client_groups.id')
			->select('register_clients.*','client_groups.group_name','client_groups.group_code')
			->where('register_clients.account_status',1)
			->get();

		$interest = DB::table('interest_on_loans')
			->select('interest_rate')
			->where('loan_type', 'Group')
			->latest()
			->first();

		$fee = DB::table('application_fees')
			->where('application_type','Group')
			->select('application_amount')
			->latest()
			->first();

		$loanNumber = $this->loanNumber();

		return view('apply.grp.index',compact('groups','loan','register','interest','fee','loanNumber'));
	}

	public function NewGroupApplication(){

			$check = DB::table('loan_applications')
					->where('id_client',request('id_client'))
					->where('loan_status','!=','completed')
					->get();
			if(sizeof($check) > 0){
				return redirect()->route('viewLoanList',[request('id_client')])->with('error','You have '.sizeof($check). ' incomplete loan(s). Please complete the current running loan or resume the exisiting loan application');
			}else{

				$loanApp = new LoanApplication();

				$loanApp->id_client = request('id_client');

				$loanApp->application_fee = str_replace(',','',request('application_fee'));

				$loanApp->application_date = Carbon::now()->toDateTimeString();

				$loanApp->loan_number = request('loan_number');

				$loanApp->interest_rate = request('interest_rate');

				$loanApp->id_group = request('id_group');

				$loanApp->application_by = Auth::id();

				$loanApp->save();

				return redirect()->back()->with('success', 'Loan Application Successful');
			}

	}

	public function viewIndividualApplication() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', '=', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.assessment_status','=',NULL)
			->where('loan_applications.id_group','=',NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		return view('apply.teller.ind.index', compact('apps'));
	}

	public function adminViewIndividualApplication() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', '=', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.assessment_status','=',NULL)
			->where('loan_applications.id_group','=',NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		return view('apply.admin.ind.application', compact('apps'));
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

			$loan->proposed_amount = str_replace(',','',request('proposed_amount'));
			$loan->loan_period = request('loan_period');
			$loan->borrowing_purpose = request('borrowing_purpose');
			$loan->income_sources = request('income_sources');
			$loan->save();

			return redirect()->route('viewSingle')->with('success', 'Success');
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
			->where('register_clients.id_group',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

		$running = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.loan_status', 'started')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->orderBy('loan_applications.created_at', 'desc')->get();
		$completed = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('register_clients.id_group',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();

		return view('apply.teller.ind.processed', compact('apps', 'running', 'completed'));
	}

	public function adminViewIndividualProcessedLoans() {

		switch(Auth::user()->role){

			case 'Manager':

				$apps = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

				$running = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('loan_applications.loan_status', '=', 'started')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->orderBy('loan_applications.created_at', 'desc')->get();
				$completed = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();
				$suspended = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('loan_applications.loan_status', '=', 'suspended')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->orderBy('loan_applications.created_at', 'desc')->get();

				break;

				case 'Supervisor':

				$apps = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

				$running = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('loan_applications.loan_status', '=', 'started')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->orderBy('loan_applications.created_at', 'desc')->get();
				$completed = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();
				$suspended = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('loan_applications.loan_status', '=', 'suspended')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->orderBy('loan_applications.created_at', 'desc')->get();

				break;

				case 'None':

				$apps = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.application_by',Auth::user()->id)
					->where('loan_applications.loan_status', '=', NULL)->orderBy('loan_applications.created_at', 'desc')->get();

				$running = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('loan_applications.loan_status', '=', 'started')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.application_by',Auth::user()->id)
					->orderBy('loan_applications.created_at', 'desc')->get();
				$completed = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.application_by',Auth::user()->id)
					->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();
				$suspended = DB::table('loan_applications')
					->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
					->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
					->where('loan_applications.loan_status', '=', 'suspended')
					->where('register_clients.id_group',NULL)
					->where('loan_applications.approval_status', '=', '1')
					->where('loan_applications.assessment_status', '=', '1')
					->where('loan_applications.application_by',Auth::user()->id)
					->orderBy('loan_applications.created_at', 'desc')->get();

				break;
		}
		

		return view('apply.admin.ind.processed', compact('apps', 'running', 'completed','suspended'));
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

		$validator = $request->validate([
			    'password' => ['required', new ValidatePassword(auth()->user())]
			]);

		$loan = LoanApplication::find($request->id);

		if ($loan) {

			$payment_method = request('payment_method');

			if($payment_method == 'Deduct'){

				$loan_amount_issued = $loan->loan_amount_issued;

				$loan_processing_fee = $loan->loan_processing_fee;

				$loan_processing_fee_status = 1;

				$application_fee = $loan->application_fee;

				$loan_amount_issued -= ($loan_processing_fee + $application_fee);

				$loan->loan_amount_issued = $loan_amount_issued;

				$loan->payment_received_by = Auth::user()->id;
			}
			$loan->loan_processing_fee_status = 1;

			
			$today = Carbon::now();
			$loan->loan_status = 'started';
			$loan->start_date = $today->toDateString();
			$loan->end_date = $this->getEndDate($request->id);
			$loan->loan_balance = $loan->total_loan;
			$loan->payment_received_by = Auth::user()->id;
			$loan->issued_by = Auth::user()->id;
			$loan->save();

			return redirect()->back()->with('success', 'Loan issued successfully');
		}
	}

	public function viewClientProfile(Request $request) {

		$loan = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*','register_clients.name','register_clients.photo','register_clients.occupation','register_clients.account','register_clients.telephone','register_clients.gender','register_clients.marital_status','register_clients.work_place','register_clients.district','register_clients.resident_village','register_clients.resident_parish','register_clients.resident_division','register_clients.resident_district','register_clients.role')
			->where('loan_applications.id_client', '=', $request->id)
			->latest()->first();

		if(is_null($loan)){

			$loan = RegisterClient::where('id',$request->id)
					->first();

			$collateral = null;

			$ledger = null;

			$history = null;

			$schedule = null;

			$savings = null;

			return view('apply.view.client_profile', compact('loan', 'ledger', 'history','schedule','savings','collateral'));

		}else{

			$collateral = DB::table('loan_securities')->where(['id_loan' => $loan->id ])
						->where(['security_status' => 0])->get()->count();

			$this->checkLoanExpiry($loan->id);

			$ledger = DB::table('loan_repayments')
				->where('id_loan', '=', $loan->id)
				->get();

			$history = DB::table('loan_applications')
				->where('id_client', '=',$request->id)
				->orderBy('created_at', 'desc')
				->get();

			$schedule = DB::table('loan_schedules')
				->where('id_loan',$loan->id)
				->get();
			$savings = DB::table('client_savings')
				->where('id_client',$request->id)
				->orderBy('created_at','asc')
				->get();
			return view('apply.view.client_profile', compact('loan', 'ledger', 'history','schedule','savings','collateral'));

		}
		
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

		return view('apply.teller.grp.index', compact('apps'));
	}
	
	public function adminViewGroupApplications() {

		$apps = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', '=', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender')
			->where('loan_applications.assessment_status','=',NULL)
			->where('loan_applications.id_group','!=',NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();

		return view('apply.admin.grp.application', compact('apps'));
	}	

	public function viewGroupProcessedLoans(){
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
			->where('loan_applications.loan_status', '=', 'started')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->orderBy('loan_applications.created_at', 'desc')->get();
		$completed = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('client_groups','client_groups.id','register_clients.id_group')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender','client_groups.group_code')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();
		return view('apply.teller.grp.processed',compact('apps', 'running', 'completed'));
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
			->where('loan_applications.loan_status', '=', 'started')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->orderBy('loan_applications.created_at', 'desc')->get();
		$completed = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('client_groups','client_groups.id','register_clients.id_group')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender','client_groups.group_code')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->where('loan_applications.loan_status', '=', 'completed')->orderBy('loan_applications.created_at', 'desc')->get();
		$suspended = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->join('client_groups','client_groups.id','register_clients.id_group')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender','client_groups.group_code')
			->where('loan_applications.loan_status', '=', 'suspended')
			->where('register_clients.id_group','!=',NULL)
			->where('loan_applications.approval_status', '=', '1')
			->where('loan_applications.assessment_status', '=', '1')
			->orderBy('loan_applications.created_at', 'desc')->get();
		return view('apply.admin.grp.processed',compact('apps', 'running', 'completed','suspended'));
	}


	public function ViewReinstateLoanForm(Request $request){

		$loan = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*','register_clients.name','register_clients.photo','register_clients.occupation','register_clients.account','register_clients.telephone','register_clients.gender','register_clients.marital_status','register_clients.work_place','register_clients.district','register_clients.resident_village','register_clients.resident_parish','register_clients.resident_division','register_clients.resident_district','register_clients.role')
			->where('loan_applications.id', '=', $request->id)
			->first();
		$end_date = strtotime($loan->end_date);

		$date_today = strtotime(date(now()));

		$days_defaulted = (int)(($date_today - $end_date)/86400);


		if(is_null($loan->id_group)){

			$rate_on_outstanding_loan = DB::table('interest_on_loan_outstandings')
										->where('loan_type','Individual')
										->select('interest_rate')
										->latest()->first();

		}else{
			$rate_on_outstanding_loan = DB::table('interest_on_loan_outstandings')
										->where('loan_type','Group')
										->select('interest_rate')
										->latest()->first();
		}

		$interest_on_outstanding_loan = (($rate_on_outstanding_loan->interest_rate/100) * $loan->loan_balance) * $days_defaulted;


		$heading = "Reinstate Loan ".$loan->loan_number;

		return view('apply.admin.loan.reinstate',compact('heading','loan','days_defaulted','interest_on_outstanding_loan'));
	}

	public function ReinstateLoan(Request $request){

		$loan = LoanApplication::find($request->id);

		$total_loan = request('total_new_loan');
		$loan_period = request('loan_extension');

		$collection = LoanSchedule::where('id_loan', $request->id)->get(['id']);
		LoanSchedule::destroy($collection->toArray());

		$instalment = round(($total_loan / $loan_period), 2);

            $data = array();

            if(is_null($loan->id_group)){
            	$today = Carbon::now()->addDays(30);

	            for ($x = 1; $x <= $loan_period; $x++) {

	                $data[] = array('id_loan' => $request->id,
	                    'instalment' => $instalment,
	                    'deadline' => $today->toDateString(),
	                );
	                $today = $today->addDays(30);
	            }
            }else{
            	$today = Carbon::now()->addDays(7);

	            for ($x = 1; $x <= $loan_period; $x++) {

	                $data[] = array('id_loan' => $request->id,
	                    'instalment' => $instalment,
	                    'deadline' => $today->toDateString(),
	                );
	                $today = $today->addDays(7);
	            }
            }  
        LoanSchedule::insert($data);
        $loan->loan_extension_comment = request('loan_extension_comment');
		$loan->total_loan = $total_loan;
		$loan->loan_recovered = null;
		$loan->loan_status = 'started';
		$loan->loan_outstanding = request('loan_outstanding');
		$loan->days_defaulted = request('days_defaulted');
		$loan->interest_loan_outstanding = request('interest_loan_outstanding');
		$loan->loan_extension_start = request('loan_extension_start');
		$loan->end_date = $this->getEndDate($request->id);
		$loan->save();
		return redirect()->back()->with('success','Success');
	}

	public function ReturnLoanSecurity(Request $request){

		$loan = DB::table('loan_applications')
				->join('register_clients','loan_applications.id_client','register_clients.id')
				->select('loan_applications.*','register_clients.name')
				->where('loan_applications.id',$request->id)
				->first();
		return view('apply.teller.trans.security.security',compact('loan'));
	}

	public function TellerIssueLoanSecurity(Request $request){

		$loan = LoanApplication::find($request->id);

		$loan->signed_security_agreement = request('signed_security_agreement');
		$loan->security = 0;
		$loan->security_status = "Taken";
		$loan->security_issued_by = Auth::user()->id;
		$loan->save();
		return redirect()->back()->with('success','Success');
	}

	public function ViewLoanProcessingForm(Request $request){

		$app = DB::table('loan_applications')
			->join('register_clients','loan_applications.id_client','register_clients.id')
			->select('register_clients.name','loan_applications.*')
			->where('loan_applications.id',$request->id)->first();
		$loans = DB::table('loan_applications')->where('loan_status','started')->orderBy('start_date','desc')->limit(30)->get();

		return view('apply.teller.trans.processing_fee.index',compact('app','loans'));

	}

	protected function getEndDate($id_loan) {

		$last = DB::table('loan_schedules')->where('id_loan',$id_loan)->orderBy('id','desc')
					->latest()->first();

		$last_date = $last->deadline;

		return $last_date;
	}

	protected function getClientId($id) {

		return DB::table('loan_applications')
			->where('id', $id)
			->select('id_client')
			->first();
	}

	protected function checkLoanExpiry($id){

		$history = DB::table('loan_applications')
			->where('id_client', '=', $this->getClientId($id)->id_client)
			->orderBy('created_at', 'desc')
			->get();

		foreach($history as $hist){
			$status = $hist->loan_status;
			$end_date = $hist->end_date;
			$id = $hist->id;

			if($status == 'started' && $end_date < Carbon::now()->format('Y-m-d')){

				$loan = LoanApplication::find($id);

				$loan->loan_status = 'suspended';

				$loan->save();
			}
		}

	}

	protected function loanNumber() {

		$id = LoanApplication::latest('loan_number')->first();

		if (is_null($id)) {

			return (101);

		} else {

			return $id->loan_number + 1;

		}
	}
}

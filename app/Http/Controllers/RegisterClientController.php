<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\RegisterClient;
use \App\Models\ClientGroup;
use Carbon\Carbon;

class RegisterClientController extends Controller {

	public function viewAccounts(){

		$accounts = RegisterClient::all();

		return view('apply.view.clients',compact('accounts'));

	}

	public function adminViewAccounts(){

		$accounts = RegisterClient::all();

		return view('apply.admin.clients',compact('accounts'));

	}

	public function viewAccountDetails(Request $request){
		$id = LoanApplication::where('id_client',$request->id)
			->latest()
			->first();
		// dd($id);
		$loan = DB::table('loan_applications')
			->join('register_clients', 'register_clients.id', 'loan_applications.id_client')
			->select('loan_applications.*', 'register_clients.*')
			->where('loan_applications.id', '=', $id->id)
			->first();
		$ledger = DB::table('loan_repayments')
			->where('id_loan', '=', $id->id)
			->get();

		$history = DB::table('loan_applications')
			->where('id_client', $request->id)
			->orderBy('created_at', 'desc')
			->get();
		$schedule = DB::table('loan_schedules')
			->where('id_loan',$id->id)
			->get();
		return view('apply.view.client_profile', compact('loan', 'ledger', 'history','schedule'));

	}

	public function singleApplication() {

		$clients = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation')
			->where('register_clients.id_group', '=', NULL)
			->where('loan_applications.application_status', '=', '1')
			->where('loan_applications.proposed_amount', '=', NULL)
			->where('loan_applications.application_by',Auth::user()->id)
			->orderBy('loan_applications.created_at', 'desc')
			->get();
		$register = RegisterClient::where('id_group',NULL)
			->get();

		$loan = $this->loanNumber();

		$interest = DB::table('interest_on_loans')
			->select('interest_rate')
			->where('loan_type', '=', 'Individual')
			->latest()
			->first();
		$fee = DB::table('appraisal_fees')
			->where('appraisal_type','=','Individual')
			->select('appraisal_amount')
			->latest()
			->first();

		return view('apply.ind.index', compact('clients', 'loan', 'register', 'interest','fee'));
	}

	public function NewIndividualApplication() {

		$loanApp = new LoanApplication();

		if (is_numeric(request('id_client'))) {

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

				return redirect()->back()->with('success', 'Loan Application Registerd Successfully');
			}

		} else {
			$client = new RegisterClient();
			$client->account = $this->accountNumber();
			$client->name = request('name');
			$client->gender = request('gender');
			$client->marital_status = request('marital_status');
			$client->telephone = request('telephone');
			$client->work_place = request('work_place');
			$client->occupation = request('occupation');
			$client->registration_date = Carbon::now()->toDateTimeString();
			$client->registered_by = Auth::id();
			$client->save();

			$loanApp->id_client = $client->id;

			$loanApp->application_fee = request('application_fee');

			$loanApp->application_date = Carbon::now()->toDateTimeString();

			$loanApp->loan_number = request('loan_number');

			$loanApp->interest_rate = request('interest_rate');

			$loanApp->application_by = Auth::id();

			$loanApp->save();

			return redirect()->back()->with('success', 'Registered Successfully');

		}

	}

	public function updateIndividualApplication(Request $request) {

		$loan = LoanApplication::find($request->id);

		if ($loan) {

			$loan->application_status = 1;

			$loan->payment_received_by = Auth::id();

			$loan->save();

			return redirect()->back()->with('success', 'Transaction successful');
		}

	}

	public function ViewClientLoanList(Request $request){
		$client = RegisterClient::where('id',$request->id)
				->first();
		$loans = DB::table('loan_applications')
					->join('users','loan_applications.application_by','users.id')
					->where('loan_applications.id_client',$request->id)
					->where('loan_applications.loan_status',NULL)
					->orWhere('loan_applications.loan_status','=','started')
					->select('loan_applications.*','users.name')
					->orderBy('loan_applications.application_date','desc')
					->get();

		return view('apply.view.loan_list',compact('client','loans'));
	}



	public function ViewGroupMembers(Request $request) {

		$id = DB::table('client_groups')->find($request->id);

		if($id){
			$group = DB::table('client_groups')
			->where('id','=',$request->id)
			->first();
			$members = RegisterClient::where('id_group','=',$request->id)
			->get();
		}

		return view('apply.settings.groups.members',compact('group','members'));
	}

	public function updateGroupMemberRole(Request $request){
		$member = RegisterClient::find($request->id);
		if($member){
			$member->role = request('role');
			$member->id_group = request('id_group');
			$member->save();
			if(request('role') == 'Group Leader'){
				$group = ClientGroup::find($member->id_group);
				$group->group_status = 1;
				$group->save();
			}
			return redirect()->back()->with('success','User role updated successfully');
		}else{
			return redirect()->back()->with('error','Record does not exist');
		}
	}


///////////////////////////////////////////////////////////////////////////////////////////////////////

	public function showGroupApplicationForm(){
		$groups = ClientGroup::where('group_status',1)
				->get();
		$interest = DB::table('interest_on_loans')
			->select('interest_rate')
			->where('loan_type', '=', 'Group')
			->latest()
			->first();
		$appraisal = DB::table('appraisal_fees')
			->select('appraisal_amount')
			->where('appraisal_type', '=', 'Group')
			->latest()
			->first();
		$loan = DB::table('loan_applications')
		->join('register_clients','loan_applications.id_client','register_clients.id')
		->join('client_groups','loan_applications.id_group','client_groups.id')
		->select('client_groups.group_name','client_groups.group_code','register_clients.name','register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation','loan_applications.*')
		->where('loan_applications.id_group','!=',NULL)
		->where('loan_applications.application_status','=',1)
		->where('loan_applications.assessment_status','=',NULL)
		->where('loan_applications.application_by',Auth::user()->id)
		->orderBy('loan_applications.created_at','desc')
		->get();

		$register = RegisterClient::where('id_group','!=',NULL)
			->get();
		$interest = DB::table('interest_on_loans')
			->select('interest_rate')
			->where('loan_type', '=', 'Group')
			->latest()
			->first();
		$fee = DB::table('appraisal_fees')
			->where('appraisal_type','=','Group')
			->select('appraisal_amount')
			->latest()
			->first();
		$loanNumber = $this->loanNumber();
		return view('apply.grp.index',compact('groups','interest','appraisal','loan','register','interest','fee','loanNumber'));
	}

	public function NewGroupApplication(){
		
		if (is_numeric(request('id_client'))) {

			$check = DB::table('loan_applications')
					->where('id_client',request('id_client'))
					->where('loan_status','!=','completed')
					->get();
			if(sizeof($check) > 0){
				return redirect()->route('viewLoanList',[request('id_client')])->with('error','You have '.sizeof($check). ' incomplete loan(s). Please complete the current running loan or resume the exisiting loan application');
			}else{

				$loanApp = new LoanApplication();

				$loanApp->id_client = request('id_client');

				$loanApp->application_fee = request('application_fee');

				$loanApp->application_date = Carbon::now()->toDateTimeString();

				$loanApp->loan_number = request('loan_number');

				$loanApp->interest_rate = request('interest_rate');

				$loanApp->id_group = request('id_group');

				$loanApp->application_by = Auth::id();

				$loanApp->save();

				return redirect()->back()->with('success', 'Loan Application Registerd Successfully');
			}

		}else{
			$client = new RegisterClient();
			$client->account = $this->accountNumber();
			$client->name = request('name');
			$client->gender = request('gender');
			$client->dob = request('dob');
			$client->marital_status = request('marital_status');
			$client->telephone = request('telephone');
			$client->next_of_kin = request('next_of_kin');
			$client->id_group = request('id_group');
			$client->house_head = request('house_head');
			$client->work_place = request('work_place');
			$client->occupation = request('occupation');
			$client->district = request('district');
			$client->resident_district = request('resident_district');
			$client->resident_division = request('resident_division');
			$client->resident_parish = request('resident_parish');
			$client->resident_village = request('resident_village');
			$client->registration_date = Carbon::now()->toDateTimeString();
			$client->registered_by = Auth::id();
			$client->save();

			$loanApp = new LoanApplication();

			$id_client = RegisterClient::latest('id')->where('id_group', '=',request('id_group') )->first();

			$loanApp->id_client = $id_client->id;

			$loanApp->id_group = request('id_group');

			$loanApp->application_fee = request('application_fee');

			$loanApp->application_date = Carbon::now()->toDateTimeString();

			$loanApp->loan_number =$this->loanNumber();

			$loanApp->interest_rate = request('interest_rate');

			$loanApp->application_by = Auth::id();

			$loanApp->save();

			return redirect()->back()->with('success', 'Registered Successfully');
		}

	}

	private function loanNumber() {

		$id = LoanApplication::latest('loan_number')->first();

		if (is_null($id)) {

			return (101);

		} else {

			return $id->loan_number + 1;

		}
	}

	private function accountNumber(){

		$ac = RegisterClient::latest('account')->first();

		if(is_null($ac)){

			return (1000100001);

		}else{
			return $ac->account + 1;
		}
	}
}

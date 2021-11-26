<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\RegisterClient;
use \App\Models\ClientGroup;
use Carbon\Carbon;
use App\Rules\ValidatePassword;

class RegisterClientController extends Controller {

	public function index(Request $request){
		$client = RegisterClient::where('id',$request->id)
				->first();	
		return view('apply.teller.trans.appraisal_fee.index',compact('client'));
	}

	public function RecordAppraisalFeePayment(Request $request){

		$validator = $request->validate([
			    'password' => ['required', new ValidatePassword(auth()->user())]
			]);

		$account = RegisterClient::find($request->id);

		$account->account_status = 1;

		$account->save();

		return redirect()->route('ActiveAccounts')->with('success','Account Activated Successfully');

	}

	public function viewAccounts(){

		switch(Auth::user()->category){

			case 'Individual':

				$accounts = RegisterClient::where('id_group',NULL)->where('account_status',1)->get();

			break;

			case 'Group':

				$accounts = RegisterClient::where('id_group','!=',NULL)->where('account_status',1)->get();

			break;

			default:

				$accounts = RegisterClient::where('account_status',1)->get();

			break;
		}

		return view('apply.accounts.clients',compact('accounts'));

	}

	public function adminViewAccounts(){

		$accounts = RegisterClient::all();

		return view('apply.admin.clients',compact('accounts'));

	}

	public function viewAccountDetails(Request $request){

		$id = LoanApplication::where('id_client',$request->id)
			->latest()
			->first();

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

		$savings = DB::table('client_savings')
			->where('id_client',$request->id)
			->orderBy('created_at','asc')
			->get();

		return view('apply.view.client_profile', compact('loan', 'ledger', 'history','schedule','savings'));

	}

	public function NewAccount() {

		if(Auth::user()->category == 'Individual'){

			$appraisal = DB::table('appraisal_fees')
				->select('appraisal_amount')
				->where('appraisal_type', 'Individual')
				->latest()
				->first();

			return view('apply.accounts.individual',compact('appraisal'));

		}elseif(Auth::user()->category == 'Group'){

			$groups = ClientGroup::get();

			$appraisal = DB::table('appraisal_fees')
				->select('appraisal_amount')
				->where('appraisal_type', 'Group')
				->latest()
				->first();


			return view('apply.accounts.group',compact('groups','appraisal'));

		}

	}	

	public function CreateAccount() {

		$client = new RegisterClient();

		if(is_numeric(request('id_group'))){
			
			$client->account = $this->accountNumber();
			$client->name = request('name');
			$client->gender = request('gender');
			$client->dob = request('dob');
			$client->marital_status = request('marital_status');
			$client->telephone = request('telephone');
			$client->next_of_kin = request('next_of_kin');
			$client->appraisal_fee = str_replace(',','',request('appraisal_fee'));
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

			return redirect()->back()->with('success', 'Account Created Successfully');

		}else{

			$client->account = $this->accountNumber();
			$client->name = request('name');
			$client->gender = request('gender');
			$client->marital_status = request('marital_status');
			$client->telephone = request('telephone');
			$client->work_place = request('work_place');
			$client->occupation = request('occupation');
			$client->appraisal_fee = str_replace(',','',request('appraisal_fee'));
			//$client->photo = $imageName;
			$client->registration_date = Carbon::now()->toDateTimeString();
			$client->registered_by = Auth::id();
			$client->save();

			return redirect()->back()->with('success', 'Account Created Successfully');
		}

	}


	public function viewAccountApplications(){

		$application = RegisterClient::where('account_status',0)
						->orderBy('created_at','desc')
						->get();

		return view('apply.accounts.applications',compact('application'));
	}

	public function updateIndividualApplication(Request $request) {

		$validator = $request->validate([
			    'password' => ['required', new ValidatePassword(auth()->user())]
			]);

		$loan = LoanApplication::find($request->id);

		if ($loan) {

			$loan->application_status = 1;


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
					->where('loan_applications.loan_status','!=','completed')
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

	private function accountNumber(){

		$ac = RegisterClient::latest('account')->first();

		if(is_null($ac)){

			return (1000100001);

		}else{
			return $ac->account + 1;
		}
	}
}

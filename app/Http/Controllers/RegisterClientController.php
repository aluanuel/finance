<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use \App\Models\LoanApplication;
use \App\Models\RegisterClient;
use \App\Models\ClientGroup;

class RegisterClientController extends Controller {
	//

	public function singleApplication() {

		$clients = DB::table('register_clients')
			->join('loan_applications', 'loan_applications.id_client', 'register_clients.id')
			->select('loan_applications.*', 'register_clients.name', 'register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation')
			->where('register_clients.id_group', '=', NULL)
			->where('loan_applications.application_status', '=', '1')
			->where('loan_applications.proposed_amount', '=', NULL)
			->orderBy('loan_applications.created_at', 'desc')
			->get();
		$register = RegisterClient::all();

		$loan = $this->loanNumber();

		$interest = DB::table('interest_on_loans')
			->select('interest_rate')
			->where('loan_type', '=', 'Individual')
			->latest()
			->first();

		return view('apply.ind.index', compact('clients', 'loan', 'register', 'interest'));
	}

	public function NewIndividualApplication() {

		$loanApp = new LoanApplication();

		if (is_numeric(request('id_client'))) {

			$loanApp->id_client = request('id_client');

			$loanApp->application_fee = request('application_fee');

			$loanApp->application_date = request('application_date');

			$loanApp->loan_number = request('loan_number');

			$loanApp->interest_rate = request('interest_rate');

			$loanApp->application_by = Auth::id();

			$loanApp->save();

			return redirect()->back()->with('success', 'Client Registerd Successfully');

		} else {
			RegisterClient::create($this->validateApplication());

			$id_client = RegisterClient::latest('id')->where('id_group', '=', NULL)->first();

			$loanApp->id_client = $id_client->id;

			$loanApp->application_fee = request('application_fee');

			$loanApp->application_date = request('application_date');

			$loanApp->loan_number = request('loan_number');

			$loanApp->interest_rate = request('interest_rate');

			$loanApp->application_by = Auth::id();

			$loanApp->save();

			return redirect()->back()->with('success', 'Client Registerd Successfully');

		}

	}
	public function updateIndividualApplication(Request $request) {

		// try(){

		$loan = LoanApplication::find($request->id);

		if ($loan) {

			$loan->application_status = 1;

			$loan->payment_received_by = Auth::id();

			$loan->save();

			return redirect()->back()->with('success', 'Transaction successful');
		}

		// }catch(Exception $e){

		// 	return redirect()->back()->with('error', 'Transaction unsuccessful');
		// }

	}
	protected function validateApplication() {

		return $data = request()->validate([
			'name' => 'required',
			'telephone' => 'required',
			'gender' => 'required',
			'marital_status' => 'required',
			'work_place' => 'required',
			'occupation' => 'required',
			'registered_by' => 'required',
			'registration_date' => 'required',
		]);
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

	public function showGroupApplicationForm(){
		$groups = ClientGroup::all();
		return view('apply.grp.index',compact('groups'));
	}

	private function loanNumber() {

		$id = LoanApplication::latest('loan_number')->first();

		if (is_null($id)) {

			return (101);

		} else {

			return $id->loan_number + 1;

		}
	}
}

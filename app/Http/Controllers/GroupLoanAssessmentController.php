<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GroupLoanAssessmentController extends Controller
{
    public function index(Request $request){
    	$cont = DB::table('loan_applications')
			->join('register_clients','loan_applications.id_client','register_clients.id')
			->join('client_groups','loan_applications.id_group','client_groups.id')
			->select('client_groups.group_name','client_groups.group_code','register_clients.name','register_clients.telephone', 'register_clients.gender', 'register_clients.marital_status', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_village', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_parish', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_division', 'register_clients.work_place', 'register_clients.occupation','register_clients.resident_district','register_clients.dob','register_clients.next_of_kin','register_clients.house_head','loan_applications.*')
			->where('loan_applications.id','=',$request->id)
			->first();
		$interest = DB::table('interest_on_loans')
			->where('loan_type','=','Group')
			->latest()
			->first();
    	return view('apply.grp.assess.index',compact('cont','interest'));
    }
}

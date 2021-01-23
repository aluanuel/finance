<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\LoanSecurity;
use DB;

class LoanSecurityController extends Controller
{
    public function index(Request $request){
    	$id = LoanSecurity::find($request->id);
    	if(is_null($id)){

    		return redirect()->back()->with('info','No collateral security found');

    	}else{
    		
	    	$security = DB::table('loan_securities')
	    				->where('id_loan',$id->id_loan)
	    				->get();
	    	$loan = DB::table('loan_applications')
	    				->join('register_clients','loan_applications.id_client','register_clients.id')
	    				->select('register_clients.name','loan_applications.*')
	    				->where('loan_applications.id',$request->id)
	    				->first();
	    	return view('apply.admin.collateral.index',compact('security','loan'));
	    }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\LoanSecurity;
use DB;

class LoanSecurityController extends Controller
{
    public function index(Request $request){
    	$id = LoanSecurity::where('id_loan',$request->id)
    		->first();
    	if(is_null($id)){

    		return redirect()->back()->with('info','No collateral security found');

    	}else{
    		
	    	$security = DB::table('loan_securities')
	    				->where('id_loan',$id->id_loan)
	    				->get();
	    	$loan = DB::table('loan_applications')
	    				->join('register_clients','register_clients.id','loan_applications.id_client')
	    				->select('register_clients.name','loan_applications.*')
	    				->where('loan_applications.id',$id->id_loan)
	    				->first();
	    	return view('apply.admin.collateral.index',compact('security','loan'));
	    }
    }

    public function issueSecurity(Request $request){
    	$agreement = LoanSecurity::where('id_loan',$request->id)
    		->get();

    	foreach($agreement as $agreement){
    		// dd($agreement->security_name);
    		$agreement ->security_agreement = request('security_agreement');

	    	$request->validate([
	            'security_agreement' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        ]);
	        $imageName = $request->id.'-'.time().'.'.$request->security_agreement->extension();

	        //$path = $request->file('avatar')->store('avatars');

	        $agreement->security_agreement = $imageName;
	    	$agreement->security_status = 1;
	    	$agreement->save();

    	}
    	return redirect()->back()->with('success','Success');
    }
}

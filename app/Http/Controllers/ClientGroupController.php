<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\ClientGroup;

class ClientGroupController extends Controller
{
    public function index(){
    	$groups = ClientGroup::all();
    	return view('apply.settings.groups.groups',compact('groups'));
    }

    public function view(){

      $groups = ClientGroup::all();
      
      return view('apply.view.grp.loan_groups',compact('groups'));
    }

    public function newLoanGroup(){

  		$group = new ClientGroup();
  		$group->group_name = request('group_name');
  		$group->group_code = $this->generateGroupCode();
  		$group->save();
    	return redirect()->back()->with('success','New Loan Group Created Successfully');

    }

    protected function generateGroupCode(){

    	$id = ClientGroup::latest('group_code')->first();

		if (is_null($id)) {

			return ('501');

		} else {

			return $id->group_code + 1;

		}

    }
}

<?php

namespace App\Http\Controllers;
use App\Models\LoanGroups;
use App\Models\Fees;
use App\Models\Clients;

use Illuminate\Http\Request;

class LoanGroupsController extends Controller
{
    public function index(){

        $groups = LoanGroups::all();

        return view('apply.settings.loan_groups.index',compact('groups'));
    }

    public function create_new_loan_group(Request $request){

        $groups = new LoanGroups();

        $groups->group_name = $request->group_name;

        $groups->group_description = $request->group_description;

        $groups->group_address = $request->group_address;

        $groups->group_code = $this->generate_group_codes();

        if($groups->save()){

            return redirect()->back()->with('success','Success');
        }

            return redirect()->back()->with('error','Error');
    }

    public function view_loan_group_members(Request $request){

        $members = Clients::where('id_loan_group',$request->id)->get();

        $group = LoanGroups::where('id',$request->id)->first();

        return view('apply.settings.loan_groups.list_group_members',compact('members','group'));
    }

    public function update_loan_group_member_role(Request $request){

        $member_role = $request->role_group;

        $member = Clients::where('id',$request->id)->first();

        $member->role_group = $member_role;

        $member->save();

        if($member_role == "Chairperson"){

            $group = LoanGroups::where('id',$member->id_loan_group)->first();

            $group->group_status = 1;

            $group->save();

        }

        return redirect()->back()->with('success','Success');

    }

    private function generate_group_codes(){

        $group = LoanGroups::latest()->first();

        if(is_null($group)){

            return 1001;

        }

            $new_group_code = $group->group_code;

            return $new_group_code +=1;

        
    }
}

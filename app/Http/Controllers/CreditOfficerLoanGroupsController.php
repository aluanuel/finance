<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CreditOfficerLoanGroups;

use App\Models\LoanGroups;

use DB;

class CreditOfficerLoanGroupsController extends Controller
{
    public function index(){

        $groups = LoanGroups::all();

        $officers = DB::table('users')->where('usertype','Credit Officer')->get();

        $assigned_groups = DB::table('users')
                            ->join('credit_officer_loan_groups','credit_officer_loan_groups.id_credit_officer','users.id')
                            ->join('loan_groups','credit_officer_loan_groups.id_loan_group','loan_groups.id')
                            ->select('users.name','credit_officer_loan_groups.*','loan_groups.group_name')
                            ->get();

        return view('apply.settings.loan_groups.credit_officers', compact('officers','groups','assigned_groups'));

    }

    public function assign_credit_officer_a_loan_group(Request $request){

        $entry = new CreditOfficerLoanGroups();

        $entry->id_credit_officer = $request->id_credit_officer;

        $entry->id_loan_group = $request->id_loan_group;

        $entry->credit_officer_role = "Member";

        if($entry->save()){

            return redirect()->back()->with('success','Success');

        }else{

            return redirect()->back()->with('error','Error');

        }

    }
}

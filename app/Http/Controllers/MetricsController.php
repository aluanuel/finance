<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use DB;

class MetricsController extends Controller
{
    public function single_loan_group(Request $request){

        $now = Carbon::now();      
        
        $start_of_week = $now->startOfWeek()->toDateString();

        $end_of_week = $now->endOfWeek()->toDateString(); 

        $officers = DB::table('credit_officer_loan_groups')
                    ->join('users','credit_officer_loan_groups.id_credit_officer','users.id')
                    ->where('credit_officer_loan_groups.id_loan_group',$request->id)
                    ->select('users.name','credit_officer_loan_groups.credit_officer_role')
                    ->get();
        $group = DB::table('loan_groups')->where('id',$request->id)->select('group_name')->first(); 

        $heading = "Showing ".$group->group_name." loan recovery for week ending ".$end_of_week;


        $outstanding = DB::table('loans')->join('clients','loans.id_client','clients.id') ->where('clients.id_loan_group',$request->id)->sum('loans.loan_outstanding');

        $group_loans = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->where('clients.id_loan_group',$request->id)
                ->where('loans.loan_status','!=','Completed')
                ->select('clients.name','loans.*')
                ->get();
         $x = 0;

        foreach($group_loans as $loan){

            $recovery = DB::table('transactions')
                        ->where('id_loan',$loan->id)
                        ->where('transaction_detail','like','%Loan Repayment%')
                        ->whereBetween('transaction_date',[$start_of_week,$end_of_week])
                        ->first();

            if(is_null($recovery)){

                $actual_recovery = 0;

                $created_at = $end_of_week;

            }else{

                $actual_recovery = $recovery->amount;

                $created_at = $recovery->created_at;
            }

            

            $single_loan_recovery[$x] = [

                                    "name" => $loan->name,
                                    "target_recovery" => $loan->instalment_amount,
                                    "actual_recovery" => $actual_recovery,
                                    "created_at" => $created_at
                                ];
            $x++;

        }

        // dd($single_loan_recovery);

        return view('apply.metrics.group.single_loan_group',compact('heading','single_loan_recovery','outstanding','officers'));
    }
}

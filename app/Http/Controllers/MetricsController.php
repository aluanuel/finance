<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use DB;

class MetricsController extends Controller
{

    public function performance_group_loan(){

        $now = Carbon::now();

        $start_of_week = $now->startOfWeek()->toDateString();

        $end_of_week = $now->endOfWeek()->toDateString(); 

        $heading = "Showing performance of loan groups from ".$now->startOfWeek()->format('d M, Y')." to ".$now->endOfWeek()->format('d M,Y');

        $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->get();

        $weekly_calendar = $this->showWeeklyData();

        $i = 0;

        foreach ($groups as $value) {
                    
                    $target_recovery = DB::table('loans')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('loans.loan_status','!=','Completed')
                                        ->sum('loans.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('loans.loan_status','!=','Completed')
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $disbursement[$i] =   [
                                                "id" => $value->id,
                                                "group_name" => $value->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "recovery_day" => $value->day_loan_recovery,
                                                "lead_credit_officer" =>$value->name
                                            ];
                    $i++;
                }

        return view('apply.metrics.group.index',compact('heading','disbursement','weekly_calendar'));
    }

    public function search_performance_group_loan(Request $request){

        

    }

    public function single_loan_group(Request $request){

        $now = Carbon::now();      
        
        $start_of_week = $now->startOfWeek()->toDateString();

        $end_of_week = $now->endOfWeek()->toDateString(); 

        $officers = DB::table('credit_officer_loan_groups')
                    ->join('users','credit_officer_loan_groups.id_credit_officer','users.id')
                    ->where('credit_officer_loan_groups.id_loan_group',$request->id)
                    ->select('users.name','credit_officer_loan_groups.credit_officer_role')
                    ->get();
        $group = DB::table('loan_groups')->where('id',$request->id)->first(); 

        $heading = "Showing ".$group->group_name." loan recovery from ".$now->startOfWeek()->format('d M, Y')." to ".$now->endOfWeek()->format('d M, Y');


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

        $weekly_calendar = $this->showWeeklyData();

        return view('apply.metrics.group.single_loan_group',compact('heading','single_loan_recovery','outstanding','officers','group','weekly_calendar'));
    }

    public function search_single_loan_group(Request $request){

        $period = explode('-',$request->period);

        $start_of_week = Carbon::parse($period[0]);

        $end_of_week = Carbon::parse($period[1]);

        $officers = DB::table('credit_officer_loan_groups')
                    ->join('users','credit_officer_loan_groups.id_credit_officer','users.id')
                    ->where('credit_officer_loan_groups.id_loan_group',$request->id)
                    ->select('users.name','credit_officer_loan_groups.credit_officer_role')
                    ->get();
        $group = DB::table('loan_groups')->where('id',$request->id)->first(); 

        $heading = "Showing ".$group->group_name." loan recovery from ".$start_of_week->format('d M, Y')." to ".$end_of_week->format('d M, Y');


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

        $weekly_calendar = $this->showWeeklyData();

        return view('apply.metrics.group.single_loan_group',compact('heading','single_loan_recovery','outstanding','officers','group','weekly_calendar'));

    }

    private function showWeeklyData(){
        // $weeks = [];

        for ($i = 0; $i < 20; $i++) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek(Carbon::MONDAY);
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek(Carbon::SUNDAY);
            $weeks[$i] = ["period" => $startOfWeek->format('d M, Y') . ' - ' . $endOfWeek->format('d M, Y')];
        }

        return $weeks;
    }
}



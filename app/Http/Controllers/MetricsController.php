<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\MyTrait;
use Carbon\Carbon;

use DB;

class MetricsController extends Controller
{
    use MyTrait;

    public function performance_group_loan(Request $request){

        $now = Carbon::now();

        $start_of_week = $now->startOfWeek()->toDateString();

        $end_of_week = $now->endOfWeek()->toDateString(); 

        $heading = "Showing performance of loan groups from ".$now->startOfWeek()->format('d M, Y')." to ".$now->endOfWeek()->format('d M,Y');

        switch($request->id){

            case 1:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->where('loan_groups.day_loan_recovery','Monday')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;
            case 2:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->where('loan_groups.day_loan_recovery','Tuesday')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;

            case 3:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->where('loan_groups.day_loan_recovery','Wednesday')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;
            case 4:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->where('loan_groups.day_loan_recovery','Thursday')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;

            case 5:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->where('loan_groups.day_loan_recovery','Friday')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;

            case 6:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->where('loan_groups.day_loan_recovery','Saturday')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;

            default:

                $groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->get();

                        break;
        }        

        $weekly_calendar = $this->show_weekly_data();

        $i = 0;

        foreach ($groups as $value) {
                    
                    $target_recovery = DB::table('loans')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('loans.loan_status','Running')
                                        ->orWhere('clients.id_loan_group',$value->id)
                                        ->where('loans.loan_status','Defaulted')
                                        ->sum('loans.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('loans.loan_status','!=','Completed')
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');


                    $start_of_recent_week = $now->startOfWeek()->subWeeks()->toDateString();

                    $end_of_recent_week = $now->endOfWeek()->toDateString();

                    // dd($end_of_recent_week);


                    $recent_target_recovery = $this->recent_target_recovery($start_of_recent_week,Carbon::now()->toDateString(),$value->id);

                    $recent_actual_recovery = $this->recent_actual_recovery($start_of_recent_week,$end_of_recent_week,$value->id);

                    $balance_recent_target_recovery = ($recent_target_recovery - $recent_actual_recovery);

                    $disbursement[$i] =   [
                                                "id" => $value->id,
                                                "group_name" => $value->group_name,
                                                "target_recovery" => $target_recovery,
                                                "balance_recent_target_recovery" => $balance_recent_target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "recovery_day" => $value->day_loan_recovery,
                                                "lead_credit_officer" =>$value->name
                                            ];
                    $i++;
                }

                // dd($disbursement);

        return view('apply.metrics.group.index',compact('heading','disbursement','weekly_calendar'));
    }

    public function search_performance_group_loan(Request $request){

        $calendar_day = $request->calendar_day;

        $period = $request->period;


        $weekly_calendar = $this->show_weekly_data();

        return view('apply.metrics.group.index',compact('heading','disbursement','weekly_calendar'));
        

    }

    public function single_loan_group(Request $request){

        $id_loan_group = $request->id;

        $now = Carbon::now();      
        
        $start_of_week = $now->startOfWeek()->toDateString();

        $end_of_week = $now->endOfWeek()->toDateString(); 

        $officers = DB::table('credit_officer_loan_groups')
                    ->join('users','credit_officer_loan_groups.id_credit_officer','users.id')
                    ->where('credit_officer_loan_groups.id_loan_group',$id_loan_group)
                    ->select('users.name','credit_officer_loan_groups.credit_officer_role')
                    ->get();
        $group = DB::table('loan_groups')->where('id',$request->id)->first(); 

        $heading = "Showing ".$group->group_name." loan recovery from ".$now->startOfWeek()->format('d M, Y')." to ".$now->endOfWeek()->format('d M, Y');


        $outstanding = DB::table('loans')->join('clients','loans.id_client','clients.id') ->where('clients.id_loan_group',$id_loan_group)->sum('loans.loan_outstanding');

        $single_member_loan_details = $this->single_group_loan_recovery($start_of_week,$end_of_week,$id_loan_group,"Running");

        $weekly_calendar = $this->show_weekly_data();

        return view('apply.metrics.group.single_loan_group',compact('heading','single_member_loan_details','outstanding','officers','group','weekly_calendar'));
    }

    public function search_single_loan_group(Request $request){

        $period = explode('-',$request->period);

        $start_of_week = Carbon::parse($period[0]);

        $end_of_week = Carbon::parse($period[1]);

        $id_loan_group = $request->id;


        $officers = DB::table('credit_officer_loan_groups')
                    ->join('users','credit_officer_loan_groups.id_credit_officer','users.id')
                    ->where('credit_officer_loan_groups.id_loan_group',$id_loan_group)
                    ->select('users.name','credit_officer_loan_groups.credit_officer_role')
                    ->get();
        $group = DB::table('loan_groups')->where('id',$id_loan_group)->first(); 

        $heading = "Showing ".$group->group_name." loan recovery from ".$start_of_week->format('d M, Y')." to ".$end_of_week->format('d M, Y');


        $outstanding = DB::table('loans')->join('clients','loans.id_client','clients.id') ->where('clients.id_loan_group',$id_loan_group)->sum('loans.loan_outstanding');

        $single_member_loan_details = $this->single_group_loan_recovery($start_of_week,$end_of_week,$id_loan_group);

        $weekly_calendar = $this->show_weekly_data();

        return view('apply.metrics.group.single_loan_group',compact('heading','single_member_loan_details','outstanding','officers','group','weekly_calendar'));

    }

    private function show_weekly_data(){

        for ($i = 0; $i < 20; $i++) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek(Carbon::MONDAY);
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek(Carbon::SUNDAY);
            $weeks[$i] = ["period" => $startOfWeek->format('d M, Y') . ' - ' . $endOfWeek->format('d M, Y')];
        }

        return $weeks;
    }

}



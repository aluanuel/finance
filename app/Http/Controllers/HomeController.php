<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $start_date = date('Y-m-d',strtotime(Carbon::now()->startOfMonth()->toDateTimeString()));
        $end_date = date('Y-m-d',strtotime(Carbon::now()->toDateTimeString()));

        $month = Carbon::now()->format('F, Y');

        $disbursement = DB::table('loans')
                        ->whereBetween('date_loan_disbursed',[$start_date,$end_date])
                        ->sum('loan_approved');

        $recovery = DB::table('transactions')
                        ->where('transaction_detail','like','%Loan Repayment%')
                        ->whereBetween('transaction_date',[$start_date,$end_date])
                        ->sum('amount');
        $completed = DB::table('loans')
                        ->where('loan_status','Completed')
                        ->whereBetween('date_loan_fully_recovered',[$start_date,$end_date])
                        ->count('loan_number');
        
        $now = Carbon::now();

        $days_of_week = $now->startOfWeek();       
        
        $start_of_week = $now->startOfWeek()->toDateString();

        $end_of_week = $now->endOfWeek()->toDateString(); 

        $day_one_of_week = $days_of_week->startOfWeek()->isoFormat('dddd, MMMM D, YYYY');

        $day_two_of_week = $days_of_week->addDays(1)->isoFormat('dddd, MMMM D, YYYY');

        $day_three_of_week = $days_of_week->addDays(1)->isoFormat('dddd, MMMM D, YYYY');

        $day_four_of_week = $days_of_week->addDays(1)->isoFormat('dddd, MMMM D, YYYY');

        $day_five_of_week = $days_of_week->addDays(1)->isoFormat('dddd, MMMM D, YYYY');

        $day_six_of_week = $days_of_week->addDays(1)->isoFormat('dddd, MMMM D, YYYY');

        $mon_groups = DB::table('loan_groups')->leftJoin('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('day_loan_disbursement','Monday')
                        ->get();

        $tue_groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('day_loan_disbursement','Tuesday')
                        ->get();

        $wed_groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('day_loan_disbursement','Wednesday')
                        ->get();

        $thur_groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('day_loan_disbursement','Thursday')
                        ->get();

        $fri_groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('day_loan_disbursement','Friday')
                        ->get();

        $sat_groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('day_loan_disbursement','Saturday')
                        ->get();
        if(sizeof($mon_groups) == 0 || sizeof($tue_groups) == 0 || sizeof($wed_groups) == 0 || sizeof($thur_groups) == 0 || sizeof($fri_groups) == 0 || sizeof($sat_groups) == 0){

            return redirect()->route('loan_groups')->with('error','Incomplete settings');

        }else{

                $i = 0; $j = 0; $k = 0; $l = 0; $x = 0; $n = 0;

                foreach ($mon_groups as $value) {
                    
                    $target_recovery = DB::table('loan_schedules')
                                        ->join('loans','loan_schedules.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->whereBetween('loan_schedules.instalment_date',[$start_of_week,$end_of_week])
                                        ->sum('loan_schedules.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $monday_disbursement[$i] =   [
                                                "group_name" => $value->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "lead_credit_officer" =>$value->name
                                            ];
                    $i++;
                }

                foreach ($tue_groups as $value) {
                    
                    $target_recovery = DB::table('loan_schedules')
                                        ->join('loans','loan_schedules.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->whereBetween('loan_schedules.instalment_date',[$start_of_week,$end_of_week])
                                        ->sum('loan_schedules.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $tuesday_disbursement[$j] =   [
                                                "group_name" => $value->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "lead_credit_officer" =>$value->name
                                            ];
                    $j++;
                }

                foreach ($wed_groups as $value) {
                    
                    $target_recovery = DB::table('loan_schedules')
                                        ->join('loans','loan_schedules.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->whereBetween('loan_schedules.instalment_date',[$start_of_week,$end_of_week])
                                        ->sum('loan_schedules.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$value->id)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $wednesday_disbursement[$i] =   [
                                                "group_name" => $value->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "lead_credit_officer" =>$value->name
                                            ];
                    $i++;
                }

                foreach ($thur_groups as $thur) {
                    
                    $target_recovery = DB::table('loan_schedules')
                                        ->join('loans','loan_schedules.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$thur->id)
                                        ->whereBetween('loan_schedules.instalment_date',[$start_of_week,$end_of_week])
                                        ->sum('loan_schedules.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$thur->id)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $thursday_disbursement[$x] =   [
                                                "group_name" => $thur->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "lead_credit_officer" =>$thur->name
                                            ];
                    $x++;
                }

                foreach ($fri_groups as $thur) {
                    
                    $target_recovery = DB::table('loan_schedules')
                                        ->join('loans','loan_schedules.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$thur->id)
                                        ->whereBetween('loan_schedules.instalment_date',[$start_of_week,$end_of_week])
                                        ->sum('loan_schedules.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$thur->id)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $friday_disbursement[$x] =   [
                                                "group_name" => $thur->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "lead_credit_officer" =>$thur->name
                                            ];
                    $x++;
                }

                foreach ($sat_groups as $thur) {
                    
                    $target_recovery = DB::table('loan_schedules')
                                        ->join('loans','loan_schedules.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$thur->id)
                                        ->whereBetween('loan_schedules.instalment_date',[$start_of_week,$end_of_week])
                                        ->sum('loan_schedules.instalment_amount');

                    $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$thur->id)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_of_week,$end_of_week])
                                        ->sum('transactions.amount');

                    $saturday_disbursement[$x] =   [
                                                "group_name" => $thur->group_name,
                                                "target_recovery" => $target_recovery,
                                                "actual_recovery" => $actual_recovery,
                                                "lead_credit_officer" =>$thur->name
                                            ];
                    $x++;
                }

            }
        
        return view('home',compact('disbursement','recovery','completed','month','monday_disbursement','tuesday_disbursement','wednesday_disbursement','thursday_disbursement','friday_disbursement','saturday_disbursement','day_one_of_week','day_two_of_week','day_three_of_week','day_four_of_week','day_five_of_week','day_six_of_week'));
    }

    
}
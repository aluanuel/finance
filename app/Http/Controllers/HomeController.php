<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\MyTrait;
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

    use MyTrait;

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

        $start_of_recent_week = $now->startOfWeek()->subWeeks()->toDateString();

        $end_of_recent_week = $now->endOfWeek()->toDateString();

        $mon_groups = DB::table('loan_groups')
                        ->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('loan_groups.day_loan_disbursement','Monday')
                        ->get();

        $tue_groups = DB::table('loan_groups')->join('users','loan_groups.id_lead_credit_officer','users.id')
                        ->select('loan_groups.*','users.name')
                        ->where('loan_groups.day_loan_disbursement','Tuesday')
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
                    
                    $monday_running_loans[$i] = [
                        "id_loan_group" => $value->id,
                        "group_name" => $value->group_name, 
                        "target_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'instalment_amount')),
                        "deficit_loan_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'deficit_loan_recovery')),
                        "actual_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'amount')),
                        "lead_credit_officer" => $value->name
                    ];

                    $i++;

                }

                // dd($monday_default_loans);

                foreach ($tue_groups as $value) {
                    
                    $tuesday_running_loans[$j] = [
                        "id_loan_group" => $value->id,
                        "group_name" => $value->group_name, 
                        "target_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'instalment_amount')),
                        "deficit_loan_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'deficit_loan_recovery')),
                        "actual_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'amount')),
                        "lead_credit_officer" => $value->name
                    ];

                    $j++;

                }

                // foreach ($wed_groups as $value) {
                    
                //     $wednesday_running_loans[$k] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name, 
                //         "target_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'instalment_amount')),
                //         "deficit_loan_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'deficit_loan_recovery')),
                //         "actual_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $wednesday_default_loans[$k] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name,
                //         "target_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'instalment_amount')),
                //         "deficit_loan_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'deficit_loan_recovery')),
                //         "actual_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $k++;
                // }

                // foreach ($thur_groups as $value) {
                    
                //     $thursday_running_loans[$i] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name, 
                //         "target_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'instalment_amount')),
                //         "deficit_loan_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'deficit_loan_recovery')),
                //         "actual_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $thursday_default_loans[$i] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name,
                //         "target_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'instalment_amount')),
                //         "deficit_loan_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'deficit_loan_recovery')),
                //         "actual_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $x++;
                // }

                // foreach ($fri_groups as $value) {
                    
                //     $friday_running_loans[$i] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name, 
                //         "target_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'instalment_amount')),
                //         "deficit_loan_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'deficit_loan_recovery')),
                //         "actual_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $friday_default_loans[$i] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name,
                //         "target_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'instalment_amount')),
                //         "deficit_loan_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'deficit_loan_recovery')),
                //         "actual_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $x++;
                // }

                // foreach ($sat_groups as $value) {
                    
                //     $saturday_running_loans[$i] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name, 
                //         "target_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'instalment_amount')),
                //         "deficit_loan_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'deficit_loan_recovery')),
                //         "actual_recovery_running_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Running"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];

                //     $saturday_default_loans[$i] = [
                //         "id_loan_group" => $value->id,
                //         "group_name" => $value->group_name,
                //         "target_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'instalment_amount')),
                //         "deficit_loan_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'deficit_loan_recovery')),
                //         "actual_recovery_defaulted_loan" => array_sum(array_column($this->single_group_loan_recovery($start_of_week,$end_of_week,$value->id,"Defaulted"), 'amount')),
                //         "lead_credit_officer" => $value->name
                //     ];                    

                //     $x++;
                // }

            }
        
        return view('home',compact('disbursement','recovery','completed','month','monday_running_loans','tuesday_running_loans','day_one_of_week','day_two_of_week','day_three_of_week','day_four_of_week','day_five_of_week','day_six_of_week'));
    }

    
}
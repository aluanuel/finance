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
        $start_date = Carbon::now()->startOfMonth()->toDateTimeString();
        $end_date = Carbon::now()->toDateTimeString();

        $clients = DB::table('register_clients')
                    ->whereBetween('registration_date',[$start_date,$end_date])
                    ->count('id');

        $individualClients = DB::table('register_clients')
                            ->where('id_group',null)
                            ->count('id');

        $groups = DB::table('client_groups')
                ->where('group_status','=',1)
                 ->count();

        $groupClients = DB::table('register_clients')
                        ->where('id_group','!=',null)
                        ->count('id'); 

        $individual_loan_application = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('application_status',1)
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $individual_loan_approval = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',1)
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $individual_loan_cancelled = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',0)
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $individual_loan_running = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('loan_status','started')
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('start_date',[$start_date,$end_date])
                                    ->count('id');
        $individual_loan_payout = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('loan_status','started')
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('start_date',[$start_date,$end_date])
                                    ->sum('proposed_amount');
        $individual_loan_outstanding = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('loan_status','!=','completed')
                                    ->where('application_by',Auth::user()->id)
                                    ->sum('loan_balance');
        $individual_loan_defaulted = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('application_by',Auth::user()->id)
                                    ->where('end_date','<',$end_date)
                                    ->count('id');

        $sup_individual_loan_application = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('application_status',1)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_individual_loan_approval = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',1)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_individual_loan_cancelled = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',0)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_individual_loan_running = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('loan_status','started')
                                    ->count('id');
        $sup_individual_loan_payout = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('loan_status','started')
                                    ->whereBetween('start_date',[$start_date,$end_date])
                                    ->sum('proposed_amount');
        $sup_individual_loan_outstanding = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('loan_status','!=','completed')
                                    ->sum('loan_balance');
        $sup_individual_loan_defaulted = DB::table('loan_applications')
                                    ->where('id_group',null)
                                    ->where('end_date','<',$end_date)
                                    ->count('id');

        $group_loan_application = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('application_status',1)
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $group_loan_approval = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',1)
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $group_loan_cancelled = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',0)
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $group_loan_running = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('loan_status','started')
                                    ->where('application_by',Auth::user()->id)
                                    ->count('id');
        $group_loan_payout = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('loan_status','started')
                                    ->where('application_by',Auth::user()->id)
                                    ->whereBetween('start_date',[$start_date,$end_date])
                                    ->sum('proposed_amount');
        $group_loan_outstanding = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('loan_status','!=','completed')
                                    ->where('application_by',Auth::user()->id)
                                    ->sum('loan_balance');
        $group_loan_defaulted = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('application_by',Auth::user()->id)
                                    ->where('end_date','<',$end_date)
                                    ->count('id');

        $sup_group_loan_application = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('application_status',1)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_group_loan_approval = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',1)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_group_loan_cancelled = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('assessment_status',1)
                                    ->where('approval_status',0)
                                    ->whereBetween('application_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_group_loan_running = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('loan_status','started')
                                    ->whereBetween('start_date',[$start_date,$end_date])
                                    ->count('id');
        $sup_group_loan_payout = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('loan_status','started')
                                    ->whereBetween('start_date',[$start_date,$end_date])
                                    ->sum('proposed_amount');
        $sup_group_loan_outstanding = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('loan_status','!=','completed')
                                    ->sum('loan_balance');
        $sup_group_loan_defaulted = DB::table('loan_applications')
                                    ->where('id_group','!=',null)
                                    ->where('end_date','<',$end_date)
                                    ->count('id');

        $application = DB::table('loan_applications')
                    ->where('payment_received_by','!=',null)
                    ->whereBetween('start_date',[$start_date,$end_date])
                    ->sum('application_fee');

        $appraisal = DB::table('register_clients')
                    ->where('account_status',1)
                    ->whereBetween('registration_date',[$start_date,$end_date])
                    ->sum('appraisal_fee');
        $processing = DB::table('loan_applications')
                    ->where('loan_processing_fee_status',1)
                    ->whereBetween('start_date',[$start_date,$end_date])
                    ->sum('loan_processing_fee');
        $disburse = DB::table('loan_applications')
                    ->where('loan_status','started')
                    ->whereBetween('start_date',[$start_date,$end_date])
                    ->sum('recommended_amount');
        $expenses = DB::table('other_payments')
                    ->where('transaction_type','expense')
                    ->whereBetween('created_at',[$start_date,$end_date])
                    ->sum('transaction_amount');
        $incomes = DB::table('other_payments')
                    ->where('transaction_type','income')
                    ->whereBetween('created_at',[$start_date,$end_date])
                    ->sum('transaction_amount');

        $assessment = $this->countTasks(Auth::user()->usertype,'loan_assessments');


        return view('home',compact('clients','individualClients','groupClients','groups','individual_loan_application','individual_loan_approval','individual_loan_cancelled','individual_loan_running','individual_loan_payout','individual_loan_outstanding','individual_loan_defaulted','sup_individual_loan_application','sup_individual_loan_approval','sup_individual_loan_cancelled','sup_individual_loan_running','sup_individual_loan_payout','sup_individual_loan_outstanding','sup_individual_loan_defaulted','group_loan_application','group_loan_approval','group_loan_cancelled','group_loan_running','group_loan_payout','group_loan_outstanding','group_loan_defaulted','sup_group_loan_application','sup_group_loan_approval','sup_group_loan_cancelled','sup_group_loan_running','sup_group_loan_payout','sup_group_loan_outstanding','sup_group_loan_defaulted','application','appraisal','processing','disburse','expenses','incomes','assessment'));
    }

    public function countTasks($usertype,$activity,$result = null){

        if($usertype == 'Loan Officer'){

            if($activity == 'loan_application'){

                $result = DB::table('loan_applications')->where('proposed_amount',null)->count('id');

            }elseif($activity == 'loan_assessments'){

                $result = DB::table('loan_applications')->where('application_status',1)
                            ->where('assessment_status',0)->count('id');

            }

            return $result;

        }elseif ($usertype == 'Teller') {
            
            $result = DB::table('loan_applications')->where('application_status',0)->count('id');

            return $result;

        }elseif ($usertype == 'Manager') {
            
            if($activity == 'loan_application'){

                $result = DB::table('loan_applications')->where('proposed_amount',null)->count('id');

            }elseif($activity == 'loan_assessments'){

                $result = DB::table('loan_applications')->where('application_status',1)
                            ->where('approval_status',0)->count('id');

            }

            return $result;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;

class ReportController extends Controller
{
    public function Collections(){
        $loan = DB::table('loan_repayments')->sum('deposit');
        $appraisal = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->sum('application_fee');
        $application = DB::table('loan_applications')
                ->where('id_group', '=',null)
                ->sum('application_fee');
        $passbook = 0;
        $processing = DB::table('loan_applications')
                    ->where('loan_processing_fee_status', '!=',null)
                    ->sum('loan_processing_fee');;
        $fine = 0;
        $security = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->sum('security');
        $total = $loan + $appraisal + $application + $passbook + $processing + $fine + $security;
        $heading = "Showing Collections As At ".Carbon::now()->toDateString();
    	return view('apply.report.collections',compact('loan','heading','appraisal','application','passbook','processing','fine','security','total'));
    }

    public function LoanRepayments(){
        $loan = DB::table('loan_repayments')
                ->join('loan_applications','loan_repayments.id_loan','loan_applications.id')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_repayments.recorded_by','users.id')
                ->select('loan_repayments.*','loan_applications.loan_number','loan_applications.id AS loan_id','register_clients.name As client','users.name')
                ->orderBy('loan_repayments.created_at','desc')->get();
        $heading = "Showing Loan Repayments As At ".Carbon::now()->toDateString();
        return view('apply.report.collections.repayment',compact('heading','loan'));
    }

    public function LoanAppraisal(){

        $appraisal = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->where('loan_applications.id_group', '!=',null)
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Appraisals As At ".Carbon::now()->toDateString();

        return view('apply.report.collections.appraisal',compact('heading','appraisal'));
    } 

    public function LoanApplication(){

        $application = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->where('loan_applications.id_group',null)
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Applications As At ".Carbon::now()->toDateString();

        return view('apply.report.collections.application',compact('heading','application'));
    }

    public function LoanProcessing(){

        $processing = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->where('loan_applications.loan_processing_fee_status','!=',null)
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Processing Fees As At ".Carbon::now()->toDateString();

        return view('apply.report.collections.processing',compact('heading','processing'));
    }

    public function LoanSecurity(){
        $security = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->select('loan_applications.*','register_clients.name as client')
                    ->where('loan_applications.security','!=',NULL)
                    ->orderBy('loan_applications.start_date','desc')
                    ->get();
        
        $heading = "Showing Loan Securities As At ".Carbon::now()->toDateString();
        return view('apply.report.collections.security',compact('heading','security'));
    }

    public function Sales(){
    	$sales = DB::table('loan_applications')
    	->where('loan_status','!=',null)
    	->orderBy('start_date','desc')
        ->limit(100)
    	->get();
        
    	return view('apply.report.sales',compact('sales'));
    }

    public function Incomes(){
        $incomes = DB::table('other_payments')
        ->where('payment_category','=','income')
        ->orderBy('created_at','desc')
        ->limit(50)
        ->get();
        $headIncome = 'Showing Recent Incomes';
        return view('apply.report.incomes',compact('incomes','headIncome'));
    }

    public function Expenses(){
        $expenses = DB::table('other_payments')
        ->where('payment_category','=','expense')
        ->orderBy('created_at','desc')
        ->limit(50)
        ->get();
        $headExpense = 'Showing Recent Expenses';
        return view('apply.report.expenses',compact('expenses','headExpense'));
    }

    public function CashBook(){
        $heading = "Showing CashBook As At ".Carbon::now()->toDateString();
        $repayments = DB::table('loan_repayments')->orderBy('created_at','desc')->get();
        $appraisal = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->orderBy('created_at','desc')
                ->get();
        $application = DB::table('loan_applications')
                ->where('id_group', '=',null)
                ->orderBy('created_at','desc')
                ->get();
        $loan = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->where('loan_applications.loan_status', '!=',null)
                ->select('register_clients.name','loan_applications.*')
                ->orderBy('loan_applications.start_date','desc')
                ->get();
        $incomes = DB::table('other_payments')
                ->where('payment_category','income')
                ->orderBy('created_at')
                ->get();
        $expenses = DB::table('other_payments')
                ->where('payment_category','expense')
                ->orderBy('created_at')
                ->get();
        return view('apply.report.cashbook',compact('heading','repayments','appraisal','application','loan','incomes','expenses'));
    }

    public function BalanceSheet(){
        return view('apply.report.balancesheet');
    }

    public function SearchIncome(){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $incomes = DB::table('other_payments')
        ->where('payment_category','=','income')
        ->whereBetween('created_at',[$start_date,$end_date])
        ->orderBy('created_at','desc')
        ->get();
        $headIncome = 'Showing Incomes Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.incomes', compact('incomes','headIncome'));
    }

    public function SearchExpense(){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $expenses = DB::table('other_payments')
        ->where('payment_category','=','expense')
        ->whereBetween('created_at',[$start_date,$end_date])
        ->orderBy('created_at','desc')
        ->get();
        $headExpense = 'Showing Expenses Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.expenses', compact('expenses','headExpense'));
    }

    public function LoanPayouts(Request $request){

        if((Auth::user()->usertype == 'Manager' && Auth::user()->role == 'Manager') || (Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'Supervisor')){

            $payout = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.application_by','users.id')
                ->where('loan_applications.loan_amount_issued','!=',NULL)
                ->select('loan_applications.*','users.name','register_clients.name as client')
                ->orderBy('loan_applications.start_date','desc')
                ->limit(150)
                ->get();

                $heading = "Showing Recent Loan Payouts";
            return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }elseif((Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'None' && Auth::user()->id = $request->id)){

                $payout = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.application_by','users.id')
                ->where('loan_applications.loan_amount_issued','!=',NULL)
                ->where('loan_applications.application_by',$request->id)
                ->select('loan_applications.*','users.name','register_clients.name as client')
                ->orderBy('loan_applications.start_date','desc')
                ->limit(150)
                ->get();

                $heading = "Showing Recent Loan Payouts";
            return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }
    }

    public function LoanOutstanding(Request $request){

        $id = $request->id;

        if(Auth::user()->id == $id){

            if(is_numeric($id)){
                $outstanding = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->join('users','loan_applications.application_by','users.id')
                    ->where('loan_applications.loan_amount_issued','!=',NULL)
                    ->where('loan_applications.loan_status','!=','completed')
                    ->where('loan_applications.application_by',)
                    ->select('loan_applications.*','users.name','register_clients.name as client')
                    ->orderBy('loan_applications.start_date','desc')
                    ->limit(150)
                    ->get();
            }else{
              $outstanding = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->join('users','loan_applications.application_by','users.id')
                    ->where('loan_applications.loan_amount_issued','!=',NULL)
                    ->where('loan_applications.loan_status','!=','completed')
                    ->select('loan_applications.*','users.name','register_clients.name as client')
                    ->orderBy('loan_applications.start_date','desc')
                    ->limit(150)
                    ->get();  
            }
            $heading = "Showing Loan Outstandings";
        return view('apply.report.loan.supervisor.outstanding',compact('outstanding','heading'));
        }
    }

    public function LoanOverdue(Request $request){
        $id = $request->id;

        if(Auth::user()->id == $id){

            if(is_numeric($id)){
                $overdue = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->join('users','loan_applications.application_by','users.id')
                    ->where('loan_applications.loan_amount_issued','!=',NULL)
                    ->where('loan_applications.loan_status','=','suspended')
                    ->where('loan_applications.application_by',$request->id)
                    ->select('loan_applications.*','users.name','register_clients.name as client')
                    ->orderBy('loan_applications.start_date','desc')
                    ->limit(150)
                    ->get();
            }else{
               $overdue = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->join('users','loan_applications.application_by','users.id')
                    ->where('loan_applications.loan_amount_issued','!=',NULL)
                    ->where('loan_applications.loan_status','=','suspended')
                    ->select('loan_applications.*','users.name','register_clients.name as client')
                    ->orderBy('loan_applications.start_date','desc')
                    ->limit(150)
                    ->get(); 
            }
        
            $heading = "Showing Loan Overdue";
            return view('apply.report.loan.supervisor.overdue',compact('overdue','heading'));
        }
    }

    public function LoanRealization(Request $request){

        $id = $request->id;

        if(Auth::user()->id == $id){

            if(is_numeric($id)){
                $real = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->join('users','loan_applications.application_by','users.id')
                    ->where('loan_applications.loan_amount_issued','!=',NULL)
                    ->where('loan_applications.loan_status','=','suspended')
                    ->where('loan_applications.application_by',$request->id)
                    ->select('loan_applications.*','users.name','register_clients.name as client')
                    ->orderBy('loan_applications.start_date','desc')
                    ->limit(150)
                    ->latest()
                    ->get();
            }else{
              $real = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->join('users','loan_applications.application_by','users.id')
                    ->where('loan_applications.loan_amount_issued','!=',NULL)
                    ->where('loan_applications.loan_status','=','suspended')
                    ->select('loan_applications.*','users.name','register_clients.name as client')
                    ->orderBy('loan_applications.start_date','desc')
                    ->limit(150)
                    ->latest()
                    ->get();  
            }
            $heading = "Showing Loans Recently Recovered";
            return view('apply.report.loan.supervisor.recovery',compact('real','heading'));
        }
    }

}

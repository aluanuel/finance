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
        $appraisal = DB::table('register_clients')
                    ->where('account_status',1)
                    ->sum('appraisal_fee');
        $application = DB::table('loan_applications')
                ->where('payment_received_by','!=',NULL)
                ->sum('application_fee');
        $incomes = DB::table('other_payments')
                ->where('transaction_type','Income')
                ->sum('transaction_amount');
        $processing = DB::table('loan_applications')
                    ->where('loan_processing_fee_status',1)
                    ->sum('loan_processing_fee');
        $security = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->sum('security');
        $total = $loan + $appraisal + $application + $incomes + $processing +  + $security;
        $heading = "Showing Collections As At ".Carbon::now()->toDateString();
    	return view('apply.report.collections',compact('loan','heading','appraisal','application','incomes','processing','security','total'));
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

    public function SearchLoanRepayments(Request $request){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();
        $loan = DB::table('loan_repayments')
                ->join('loan_applications','loan_repayments.id_loan','loan_applications.id')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_repayments.recorded_by','users.id')
                ->whereBetween('loan_repayments.created_at',[$start_date,$end_date])
                ->select('loan_repayments.*','loan_applications.loan_number','loan_applications.id AS loan_id','register_clients.name As client','users.name')
                ->orderBy('loan_repayments.created_at','desc')->get();
        $heading = 'Showing Loan Repayments Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();
        return view('apply.report.collections.repayment',compact('heading','loan'));
    }

    public function LoanAppraisal(){

        $appraisal = DB::table('register_clients')
                    ->join('users','register_clients.registered_by','users.id')
                    ->select('users.name as user','register_clients.*')
                    ->where('register_clients.account_status',1)
                    ->get();

        $heading = "Showing Appraisal Fees Payments As At ".Carbon::now()->toDateString();

        return view('apply.report.collections.appraisal',compact('heading','appraisal'));
    }

    public function SearchLoanAppraisal(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));
        $end_date = $end->addHours(23)->toDateTimeString();

        $appraisal = DB::table('register_clients')
                    ->join('users','register_clients.registered_by','users.id')
                    ->select('users.name as user','register_clients.*')
                    ->where('register_clients.account_status',1)
                    ->whereBetween('registration_date',[$start_date,$end_date])
                    ->get();

        $heading = "Showing Appraisal Fees Payments  Between " . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.collections.appraisal',compact('heading','appraisal'));
    }  

    public function LoanApplication(){

        $application = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Applications As At ".Carbon::now()->toDateString();

        return view('apply.report.collections.application',compact('heading','application'));
    }

    public function SearchLoanApplication(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));
        $end_date = $end->addHours(23)->toDateTimeString();

        $application = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Applications  Between " . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.collections.application',compact('heading','application'));
    }

    public function LoanProcessing(){

        $processing = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->where('loan_applications.loan_processing_fee_status',1)
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Processing Fees As At ".Carbon::now()->toDateString();

        return view('apply.report.collections.processing',compact('heading','processing'));
    }

    public function SearchLoanProcessing(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));
        $end_date = $end->addHours(23)->toDateTimeString();

        $processing = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.payment_received_by','users.id')
                ->where('loan_applications.loan_processing_fee_status',1)
                ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                ->select('loan_applications.*','register_clients.name As client','users.name')
                ->orderBy('loan_applications.application_date','desc')
                ->get();

        $heading = "Showing Loan Processing Fees Between " . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.collections.processing',compact('heading','processing'));
    }

    public function Passbook(){
        $book = DB::table('other_payments')
                ->join('transaction_categories','other_payments.id_category','transaction_categories.id')
                ->where('transaction_categories.transaction_category','Passbook')
                ->where('other_payments.transaction_type','Income')
                ->orderBy('other_payments.created_at','desc')
                ->get();
        $heading = "Showing Passbook Payments As At ".Carbon::now()->toDateString();
        return view('apply.report.collections.passbook',compact('heading','book'));
    }

    public function SearchPassbook(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));
        $end_date = $end->addHours(23)->toDateTimeString();

        $book = DB::table('other_payments')
                ->join('transaction_categories','other_payments.id_category','transaction_categories.id')
                ->where('transaction_categories.transaction_category','Passbook')
                ->where('other_payments.transaction_type','Income')
                ->whereBetween('other_payments.created_at',[$start_date,$end_date])
                ->orderBy('other_payments.created_at','desc')
                ->get();
        $heading = "Showing Passbook Payments Between " . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();
        return view('apply.report.collections.passbook',compact('heading','book'));
    }

    public function Fine(){
        $book = DB::table('other_payments')
                ->join('transaction_categories','other_payments.id_category','transaction_categories.id')
                ->where('transaction_categories.transaction_category','Fine')
                ->where('other_payments.transaction_type','Income')
                ->orderBy('other_payments.created_at','desc')
                ->get();
        $heading = "Showing Fines Paid As At ".Carbon::now()->toDateString();
        return view('apply.report.collections.fine',compact('heading','book'));
    }

    public function SearchFine(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));
        $end_date = $end->addHours(23)->toDateTimeString();

        $book = DB::table('other_payments')
                ->join('transaction_categories','other_payments.id_category','transaction_categories.id')
                ->where('transaction_categories.transaction_category','Fine')
                ->where('other_payments.transaction_type','Income')
                ->whereBetween('other_payments.created_at',[$start_date,$end_date])
                ->orderBy('other_payments.created_at','desc')
                ->get();
        $heading = "Showing Fines Paid Between " . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();
        return view('apply.report.collections.fine',compact('heading','book'));
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
        $incomes = $this->MergeTransactionRecords('income');
        $headIncome = 'Showing Recent Incomes';
        return view('apply.report.cashflow.incomes',compact('incomes','headIncome'));
    }

    public function Expenses(){
        $expenses = $this->MergeTransactionRecords('expense');
        $headExpense = 'Showing Recent Expenses';
        return view('apply.report.cashflow.expenses',compact('expenses','headExpense'));
    }

    public function CashBook(){
        $heading = "Showing CashBook As At ".Carbon::now()->toDateString();
        $repayments = DB::table('loan_repayments')->orderBy('created_at','desc')->get();
        $appraisal = DB::table('register_clients')
                    ->where('account_status',1)
                    ->orderBy('registration_date','desc')
                    ->get();
        $application = DB::table('loan_applications')
                ->where('payment_received_by','!=',NULL)
                ->orderBy('created_at','desc')
                ->get();
        $loan = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->where('loan_applications.loan_status', '!=',null)
                ->select('register_clients.name','loan_applications.*')
                ->orderBy('loan_applications.start_date','desc')
                ->get();
        $incomes = DB::table('other_payments')
                ->join('transaction_categories','transaction_categories.id','other_payments.id_category')
                ->where('other_payments.transaction_type','income')
                ->orderBy('other_payments.created_at')
                ->get();
        $expenses = DB::table('other_payments')
                ->join('transaction_categories','transaction_categories.id','other_payments.id_category')
                ->where('other_payments.transaction_type','expense')
                ->orderBy('other_payments.created_at')
                ->get();
        return view('apply.report.cashbook',compact('heading','repayments','appraisal','application','loan','incomes','expenses'));
    }

    public function SearchCashBook(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $heading = $headExpense = 'Showing CashBook Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        $repayments = DB::table('loan_repayments')
                ->whereBetween('created_at',[$start_date,$end_date])
                ->orderBy('created_at','desc')->get();
        $appraisal = DB::table('register_clients')
                    ->where('account_status',1)
                    ->whereBetween('registration_date',[$start_date,$end_date])
                    ->orderBy('registration_date','desc')
                    ->get();

        $application = DB::table('loan_applications')
                ->where('payment_received_by','!=',NULL)
                ->whereBetween('start_date',[$start_date,$end_date])
                ->orderBy('created_at','desc')
                ->get();
        $loan = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->where('loan_applications.loan_status', '!=',null)
                ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                ->select('register_clients.name','loan_applications.*')
                ->orderBy('loan_applications.start_date','desc')
                ->get();
        $incomes = DB::table('other_payments')
                ->join('transaction_categories','transaction_categories.id','other_payments.id_category')
                ->where('other_payments.transaction_type','income')
                ->whereBetween('other_payments.created_at',[$start_date,$end_date])
                ->orderBy('other_payments.created_at')
                ->get();
        $expenses = DB::table('other_payments')
                ->join('transaction_categories','transaction_categories.id','other_payments.id_category')
                ->where('other_payments.transaction_type','expense')
                ->whereBetween('other_payments.created_at',[$start_date,$end_date])
                ->orderBy('other_payments.created_at')
                ->get();
        return view('apply.report.cashbook',compact('heading','repayments','appraisal','application','loan','incomes','expenses'));
    }

    public function BalanceSheet(){

        // $start_date = Carbon::create()->toDateTimeString();
        // $end = Carbon::create(request('end_date'));

        $currentAssets = $this->CurrentAssets();

        $currentLiabilities = $this->CurrentLiabilities();

        return view('apply.report.balancesheet',compact('currentAssets','currentLiabilities'));
    }

    public function SearchIncome(){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $incomes = $this->MergeTransactionRecords('income',$start_date,$end_date);
        $headIncome = 'Showing Incomes Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.cashflow.incomes', compact('incomes','headIncome'));
    }

    public function SearchExpense(){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $expenses = $this->MergeTransactionRecords('expense',$start_date,$end_date);

        $headExpense = 'Showing Expenses Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.cashflow.expenses', compact('expenses','headExpense'));
    }

    public function SearchLoanSecurity(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $security = DB::table('loan_applications')
                    ->join('register_clients','loan_applications.id_client','register_clients.id')
                    ->select('loan_applications.*','register_clients.name as client')
                    ->where('loan_applications.security','!=',NULL)
                    ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                    ->orderBy('loan_applications.start_date','desc')
                    ->get();
        
        $heading = "Showing Loan Securities Between " . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();
        return view('apply.report.collections.security',compact('heading','security'));
    }

    public function LoanPayouts(Request $request){

        if(Auth::user()->usertype == 'Manager' && Auth::user()->role == 'Manager'){

            $payout = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.application_by','users.id')
                ->where('loan_applications.loan_amount_issued','!=',NULL)
                ->select('loan_applications.*','users.name','register_clients.name as client')
                ->orderBy('loan_applications.start_date','desc')
                ->limit(150)
                ->get();

                $heading = "Showing Loans Recently Disbursed";
            return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }elseif((Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'Supervisor')){


            if(Auth::user()->category == 'Individual'){

                    $payout = DB::table('loan_applications')
                            ->join('register_clients','loan_applications.id_client','register_clients.id')
                            ->join('users','loan_applications.application_by','users.id')
                            ->where('loan_applications.loan_amount_issued','!=',NULL)
                            ->where('loan_applications.id_group',NULL)
                            ->select('loan_applications.*','users.name','register_clients.name as client')
                            ->orderBy('loan_applications.start_date','desc')
                            ->limit(150)
                            ->get();
                    $heading = "Showing Individual Loans Recently Disbursed";

            }elseif(Auth::user()->category == 'Group'){

                    $payout = DB::table('loan_applications')
                            ->join('register_clients','loan_applications.id_client','register_clients.id')
                            ->join('users','loan_applications.application_by','users.id')
                            ->where('loan_applications.loan_amount_issued','!=',NULL)
                            ->where('loan_applications.id_group','!=',NULL)
                            ->select('loan_applications.*','users.name','register_clients.name as client')
                            ->orderBy('loan_applications.start_date','desc')
                            ->limit(150)
                            ->get();
                    $heading = "Showing Group Loans Recently Disbursed";

            }

                return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }elseif((Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'None')){

                $payout = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.application_by','users.id')
                ->where('loan_applications.loan_amount_issued','!=',NULL)
                ->where('loan_applications.application_by',Auth::user()->id)
                ->select('loan_applications.*','users.name','register_clients.name as client')
                ->orderBy('loan_applications.start_date','desc')
                ->limit(150)
                ->get();

                $heading = "Showing Loans Recently Disbursed";
            return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }
    }

    public function SearchLoanPayouts(Request $request){

        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        if(Auth::user()->usertype == 'Manager' && Auth::user()->role == 'Manager'){

            $payout = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.application_by','users.id')
                ->where('loan_applications.loan_amount_issued','!=',NULL)
                ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                ->select('loan_applications.*','users.name','register_clients.name as client')
                ->orderBy('loan_applications.start_date','desc')
                ->limit(150)
                ->get();

                $heading = 'Showing Loans Disbursed Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

            return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }elseif((Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'Supervisor')){


            if(Auth::user()->category == 'Individual'){

                    $payout = DB::table('loan_applications')
                            ->join('register_clients','loan_applications.id_client','register_clients.id')
                            ->join('users','loan_applications.application_by','users.id')
                            ->where('loan_applications.loan_amount_issued','!=',NULL)
                            ->where('loan_applications.id_group',NULL)
                            ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                            ->select('loan_applications.*','users.name','register_clients.name as client')
                            ->orderBy('loan_applications.start_date','desc')
                            ->limit(150)
                            ->get();
                    
                    $heading = 'Showing Individual Loans Disbursed Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

            }elseif(Auth::user()->category == 'Group'){

                    $payout = DB::table('loan_applications')
                            ->join('register_clients','loan_applications.id_client','register_clients.id')
                            ->join('users','loan_applications.application_by','users.id')
                            ->where('loan_applications.loan_amount_issued','!=',NULL)
                            ->where('loan_applications.id_group','!=',NULL)
                            ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                            ->select('loan_applications.*','users.name','register_clients.name as client')
                            ->orderBy('loan_applications.start_date','desc')
                            ->limit(150)
                            ->get();

                    $heading = 'Showing Group Loans Disbursed Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

            }

                return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }elseif((Auth::user()->usertype == 'Loan Officer' && Auth::user()->role == 'None')){

                $payout = DB::table('loan_applications')
                ->join('register_clients','loan_applications.id_client','register_clients.id')
                ->join('users','loan_applications.application_by','users.id')
                ->where('loan_applications.loan_amount_issued','!=',NULL)
                ->where('loan_applications.application_by',Auth::user()->id)
                ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                ->select('loan_applications.*','users.name','register_clients.name as client')
                ->orderBy('loan_applications.start_date','desc')
                ->limit(150)
                ->get();

                $heading = 'Showing Loans Disbursed Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

            return view('apply.report.loan.supervisor.payout',compact('payout','heading'));

        }
    }

    public function LoanOutstanding(){

            $outstanding = null;

            $user = Auth::user();

            switch($user->role){

                case 'None':

                    $outstanding = DB::table('loan_applications')
                        ->join('register_clients','loan_applications.id_client','register_clients.id')
                        ->join('users','loan_applications.application_by','users.id')
                        ->where('loan_applications.loan_amount_issued','!=',NULL)
                        ->where('loan_applications.loan_status','!=','completed')
                        ->where('loan_applications.application_by',$user->id)
                        ->select('loan_applications.*','users.name','register_clients.name as client')
                        ->orderBy('loan_applications.start_date','desc')
                        ->limit(150)
                        ->get();

                    break;

                case 'Supervisor':

                        if($user->category == 'Individual'){

                            $outstanding = DB::table('loan_applications')
                                ->join('register_clients','loan_applications.id_client','register_clients.id')
                                ->join('users','loan_applications.application_by','users.id')
                                ->where('loan_applications.loan_amount_issued','!=',NULL)
                                ->where('loan_applications.loan_status','!=','completed')
                                ->where('register_clients.id_group',NULL)
                                ->select('loan_applications.*','users.name','register_clients.name as client')
                                ->orderBy('loan_applications.start_date','desc')
                                ->limit(150)
                                ->get();

                        }elseif ($user->category == 'Group') {
                            $outstanding = DB::table('loan_applications')
                                ->join('register_clients','loan_applications.id_client','register_clients.id')
                                ->join('users','loan_applications.application_by','users.id')
                                ->where('loan_applications.loan_amount_issued','!=',NULL)
                                ->where('loan_applications.loan_status','!=','completed')
                                ->where('register_clients.id_group','!=',NULL)
                                ->select('loan_applications.*','users.name','register_clients.name as client')
                                ->orderBy('loan_applications.start_date','desc')
                                ->limit(150)
                                ->get();
                        }

                    

                    break;

                case 'Manager':

                    $outstanding = DB::table('loan_applications')
                        ->join('register_clients','loan_applications.id_client','register_clients.id')
                        ->join('users','loan_applications.application_by','users.id')
                        ->where('loan_applications.loan_amount_issued','!=',NULL)
                        ->where('loan_applications.loan_status','!=','completed')
                        ->select('loan_applications.*','users.name','register_clients.name as client')
                        ->orderBy('loan_applications.start_date','desc')
                        ->limit(150)
                        ->get();

                    break;
            }
            $heading = "Showing Loan Outstandings";
        return view('apply.report.loan.supervisor.outstanding',compact('outstanding','heading'));
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

    public function LoanList(){

            $list = DB::table('loan_applications')
                        ->join('register_clients','loan_applications.id_client','register_clients.id')
                        ->join('users','loan_applications.application_by','users.id')
                        ->where('loan_applications.loan_amount_issued','!=',NULL)
                        ->where('loan_applications.loan_status','!=',null)
                        ->select('loan_applications.*','users.name','register_clients.name as client')
                        ->orderBy('loan_applications.start_date','desc')
                        ->limit(150)
                        ->get();
                    
            $heading = "Showing Loan Outstandings";

        return view('apply.report.analysis.loan',compact('heading','list'));
    }

    public function LoanDisbursements(){
        $heading = "Showing Loan Disbursements";
        $loans = DB::table('register_clients')
                ->join('loan_applications','register_clients.id','loan_applications.id_client')
                ->where('loan_applications.loan_amount_issued','!=',null)
                ->select('register_clients.name','loan_applications.*')
                ->orderBy('loan_applications.start_date','desc')
                ->get();
        return view('apply.report.loan.disbursements', compact('heading','loans'));
    }

    public function SearchLoanDisbursements(Request $request){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();


        $loans = DB::table('register_clients')
                ->join('loan_applications','register_clients.id','loan_applications.id_client')
                ->where('loan_applications.loan_amount_issued','!=',null)
                ->select('register_clients.name','loan_applications.*')
                ->whereBetween('loan_applications.start_date',[$start_date,$end_date])
                ->orderBy('loan_applications.start_date','desc')
                ->get();
        $heading = "Showing Loan Disbursements Between ".Carbon::create($start_date)->toFormattedDateString() . ' And ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.loan.disbursements', compact('heading','loans'));
    }

    public function LoanPerformance(Request $request){

            $loan = DB::table('loan_applications')
                        ->join('register_clients','loan_applications.id_client','register_clients.id')
                        ->join('users','loan_applications.application_by','users.id')
                        ->where('loan_applications.loan_amount_issued','!=',NULL)
                        ->where('loan_applications.id',$request->id)
                        ->select('loan_applications.*','users.name','register_clients.name as client')
                        ->first();

        return view('apply.report.analysis.single',compact('loan'));
    }

    protected function CashBookBalance(Request $request){

        $end_date = Carbon::create($request->end_date)->toDateTimeString();


        $repayments = DB::table('loan_repayments')->orderBy('created_at','desc')->get();

        $appraisal = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->where('payment_received_by', '!=',null)
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

        $repayments = DB::table('loan_repayments')->sum('deposit')->where('created_at','<',$end_date);
        $appraisal = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->sum('application_fee');
        $application = DB::table('loan_applications')
                ->where('id_group', '=',null)
                ->sum('application_fee');
        $passbook = DB::table('other_payments')
                ->where('payment_name','Passbook')
                ->where('payment_category','Income')
                ->sum('payment_amount');
        $processing = DB::table('loan_applications')
                    ->where('loan_processing_fee_status',1)
                    ->sum('loan_processing_fee');;
        $fine = DB::table('other_payments')
                ->where('payment_name','Fine')
                ->where('payment_category','Income')
                ->sum('payment_amount');
        $security = DB::table('loan_applications')
                ->where('id_group', '!=',null)
                ->sum('security');

    }

    private function MergeTransactionRecords($transaction_type,$start_date = null,$end_date = null){

        $records = array();

        $values = DB::table('transaction_categories')
                    ->where('transaction_type',$transaction_type)
                    ->get();

        if(is_null($start_date) || is_null($end_date)){

            for( $i = 0; $i < sizeof($values); $i++){

            $total = DB::table('other_payments')
                    ->where('id_category',$values[$i]->id)
                    ->sum('transaction_amount');

                 $records[$i] = ['id_category'=>$values[$i]->id,'transaction_category' => $values[$i]->transaction_category,'transaction_amount' => $total];

            }

        }else{

            for( $i = 0; $i < sizeof($values); $i++){

            $total = DB::table('other_payments')
                    ->where('id_category',$values[$i]->id)
                    ->whereBetween('created_at',[$start_date,$end_date])
                    ->sum('transaction_amount');

                 $records[$i] = ['id_category'=>$values[$i]->id,'transaction_category' => $values[$i]->transaction_category,'transaction_amount' => $total];

            }

        }

        $collection = collect($records);

        return $collection;

    }

    public function CashFlowDetails(Request $request){

        $heading = DB::table('transaction_categories')
                    ->where('id',$request->id)
                    ->first();

        $details = DB::table('transaction_sub_categories')
                ->join('other_payments','transaction_sub_categories.id_transaction_category','other_payments.id_category')
                ->where('other_payments.id_category',$request->id)
                ->get();
       if(sizeof($details) > 0){

            $header = 'Showing Transaction Details for '.$heading->transaction_category;

            return view('apply.report.cashflow.cashflow_details',compact('heading','header','details'));

       }else{

            return redirect()->back()->with('info','No transaction sub categories found for '.$heading->transaction_category);
       }
    }

    private function CurrentAssets($start_date = null,$end_date = null){

        $loans = DB::table('loan_applications')
                            ->sum('total_loan');
        $application_fee = DB::table('loan_applications')
                            ->whereBetween('created_at',[$start_date,$end_date])
                            ->sum('application_fee');
        $processing_fee = DB::table('loan_applications')
                            ->whereBetween('created_at',[$start_date,$end_date])
                            ->sum('loan_processing_fee');
        $loan_security = DB::table('loan_applications')
                            ->whereBetween('created_at',[$start_date,$end_date])
                            ->sum('security');
        $other_payments = DB::table('other_payments')
                            ->where('transaction_type','income')
                            ->whereBetween('created_at',[$start_date,$end_date])
                            ->sum('transaction_amount');
        return ($loans + $other_payments + $application_fee + $processing_fee + $loan_security);
    }

    private function CurrentLiabilities($start_date = null,$end_date = null){

        $other = DB::table('other_payments')
                            ->where('transaction_type','expense')
                            ->sum('transaction_amount');
        return ($other);
    }

}

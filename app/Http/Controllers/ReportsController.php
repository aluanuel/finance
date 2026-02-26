<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ReportsController extends Controller
{
    public function report_loan_disbursements(Request $request){

        $period = $request->id;

        if(empty($period)){

            $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                ->select('clients.name','clients.account_number','loans.interest_rate','loans.loan_approved','loans.date_loan_disbursed','loans.loan_processing_rate','loans.total_loan','loans.loan_number','loans.loan_status')
                ->where('loans.loan_status','Running')
                ->orderBy('loans.date_loan_disbursed','desc')
                ->get();

            $heading = "View recent loan disbursement";

            return view('apply.report.loan_disbursement',compact('loan','heading'));

        }else{

            $start_date = date('Y-m-d',strtotime(Carbon::now()->startOfMonth()->toDateTimeString()));
            $end_date = date('Y-m-d',strtotime(Carbon::now()->toDateTimeString()));

            $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                ->select('clients.name','clients.account_number','loans.interest_rate','loans.loan_approved','loans.date_loan_disbursed','loans.loan_processing_rate','loans.total_loan','loans.loan_number','loans.loan_status')
                ->where('loans.loan_status','Running')
                ->whereBetween('loans.date_loan_disbursed',[$start_date,$end_date])
                ->get();

            $heading = "View loan disbursements in ".Carbon::now()->format('F, Y');

            return view('apply.report.loan_disbursement',compact('loan','heading'));

        }

    }

    public function query_report_loan_disbursements(Request $request){

        $start_date = $request->start_date;

        $end_date = $request->end_date;

        $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                ->select('clients.name','clients.account_number','loans.interest_rate','loans.loan_approved','loans.date_loan_disbursed','loans.loan_processing_rate','loans.total_loan','loans.loan_number','loans.loan_status')
                ->where('loans.loan_status','Running')
                ->whereBetween('loans.date_loan_disbursed',[$start_date,$end_date])
                ->get();

        $heading = "View loan disbursements from ".date('F d, Y',strtotime($start_date))." to ".date('F d, Y',strtotime($end_date));

        return view('apply.report.loan_disbursement',compact('loan','heading'));

    }

    public function report_loan_recovery(Request $request){

        $period = $request->id;

        if(empty($period)){

            $recovery = DB::table('loans')->join('clients','loans.id_client','clients.id')
                ->join('transactions','transactions.id_loan','loans.id')
                ->join('ledgers','ledgers.id_loan','loans.id')
                ->select('clients.name','loans.loan_number','loans.loan_status','transactions.amount','transactions.transaction_date','ledgers.*')
                ->where('transactions.transaction_detail','like','%Loan Repayment%')
                ->orderBy('transactions.transaction_date','desc')
                ->limit(500)
                ->get();

            $heading = "View recent loan recovery";

            return view('apply.report.loan_recovery',compact('recovery','heading'));

        }else{

            $start_date = date('Y-m-d',strtotime(Carbon::now()->startOfMonth()->toDateTimeString()));
            $end_date = date('Y-m-d',strtotime(Carbon::now()->toDateTimeString()));

            $recovery = DB::table('loans')->join('clients','loans.id_client','clients.id')
                ->join('transactions','transactions.id_loan','loans.id')
                ->join('ledgers','ledgers.id_loan','loans.id')
                ->select('clients.name','loans.loan_number','loans.loan_status','transactions.amount','transactions.transaction_date','ledgers.*')
                ->where('transactions.transaction_detail','like','%Loan Repayment%')
                ->whereBetween('transactions.transaction_date',[$start_date,$end_date])
                ->orderBy('transactions.transaction_date','desc')
                ->get();

            $heading = 'View loan recovery in '.Carbon::now()->format('F, Y');

            return view('apply.report.loan_recovery',compact('recovery','heading'));
        }


    }

    public function query_report_loan_recovery(Request $request){

        $start_date = $request->start_date;

        $end_date = $request->end_date;

        $recovery = DB::table('loans')->join('clients','loans.id_client','clients.id')
                ->join('transactions','transactions.id_loan','loans.id')
                ->join('ledgers','ledgers.id_loan','loans.id')
                ->select('clients.name','loans.loan_number','loans.loan_status','transactions.amount','transactions.transaction_date','ledgers.*')
                ->where('transactions.transaction_detail','like','%Loan Repayment%')
                ->whereBetween('transactions.transaction_date',[$start_date,$end_date])
                ->orderBy('transactions.transaction_date','desc')
                ->get();

        $heading = "View loan recovery from ".date('F d, Y',strtotime($start_date))." to ".date('F d, Y',strtotime($end_date));

        return view('apply.report.loan_recovery',compact('recovery','heading'));

    }

    public function report_loans_completed(Request $request){

        $period = $request->id;

        if(empty($period)){

            $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                    ->select('clients.name','loans.*')
                    ->where('loans.loan_status','Completed')
                    ->orderBy('loans.loan_number','desc')
                    ->get();
            $heading = 'View loans completed recently';

        }else{

            $start_date = date('Y-m-d',strtotime(Carbon::now()->startOfMonth()->toDateTimeString()));
            $end_date = date('Y-m-d',strtotime(Carbon::now()->toDateTimeString()));

            $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                    ->select('clients.name','loans.*')
                    ->where('loans.loan_status','Completed')
                    ->whereBetween('loans.date_loan_fully_recovered',[$start_date,$end_date])
                    ->orderBy('loans.loan_number','desc')
                    ->get();

            $heading = 'View loans completed in '.Carbon::now()->format('F, Y');

        }

        return view('apply.report.loans_completed',compact('loan','heading'));
    }

    public function query_report_loans_completed(Request $request){

        $start_date = $request->start_date;

        $end_date = $request->end_date;

        $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                    ->select('clients.name','loans.*')
                    ->where('loans.loan_status','Completed')
                    ->whereBetween('loans.date_loan_fully_recovered',[$start_date,$end_date])
                    ->orderBy('loans.loan_number','desc')
                    ->get();

        $heading = "View loans completed from ".date('F d, Y',strtotime($start_date))." to ".date('F d, Y',strtotime($end_date));

        return view('apply.report.loans_completed',compact('loan','heading'));

    }

    public function report_loans_defaulted(){

            $loan = DB::table('loans')->join('clients','loans.id_client','clients.id')
                    ->select('clients.name','loans.*')
                    ->where('loans.loan_status','Defaulted')
                    ->orderBy('loans.loan_end_date','desc')
                    ->get();
            $heading = 'View loans defaulted';

        return view('apply.report.loans_defaulted',compact('loan','heading'));
    }

    public function report_cashbook(){

        $trans = DB::table('transactions')->where('created_at','like','%'.date('Y-m-d').'%')->orderBy('id','desc')->get();

        $heading = "View cashbook statement";

        return view('apply.report.teller.cashbook',compact('trans','heading'));
    } 

    public function query_report_cashbook(Request $request){

        $start_date = $request->start_date.' 00:00:00';

        $end_date = $request->end_date.' 23:59:59';



        $trans = DB::table('transactions')->whereBetween('created_at',[$start_date,$end_date])->orderBy('id','desc')->get();

        $heading = "View cashbook statement from ".date('F d, Y',strtotime($start_date))." to ".date('F d, Y',strtotime($end_date));

        return view('apply.report.teller.cashbook',compact('trans','heading'));
    } 

}

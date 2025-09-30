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
                        ->where('loan_status','Running')
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

        return view('home',compact('disbursement','recovery','completed','month'));
    }

    
}

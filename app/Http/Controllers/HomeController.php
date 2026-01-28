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
                        ->count('loan_number');

        $defaulted = DB::table('loans')
                        ->where('loan_status','Defaulted')
                        ->whereBetween('loan_end_date',[$start_date,$end_date])
                        ->count('loan_number');

        $completed = DB::table('loans')
                        ->where('loan_status','Completed')
                        ->whereBetween('date_loan_fully_recovered',[$start_date,$end_date])
                        ->count('loan_number');

        $new_clients = DB::table('clients')
                        ->whereBetween('created_at',[Carbon::now()->startOfMonth()->toDateTimeString(),Carbon::now()->toDateTimeString()])
                        ->count('id');
        $loan_groups = DB::table('loan_groups')->where('group_status',1)->count('id');

        $clients = DB::table('clients')->count('id');

        return view('home',compact('disbursement','defaulted','completed','new_clients','loan_groups','clients','month'));
    }

    
}

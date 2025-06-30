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

        $disbursement = DB::table('loans')
                        ->where('loans.loan_status','Running')
                        ->sum('loan_approved');

        $recovery = DB::table('transactions')
                        ->sum('amount');

        return view('home',compact('disbursement','recovery'));
    }

    
}

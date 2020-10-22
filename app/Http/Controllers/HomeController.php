<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        $individualLoans = DB::table('loan_applications')
        ->where('loan_status','=','started')
        ->where('id_group','=',null)
        ->count('id');

        $groupLoans = DB::table('loan_applications')
        ->where('loan_status','=','started')
        ->where('id_group','!=',null)
        ->count('id');  

        $newIndividualClients = DB::table('register_clients')
        ->where('id_group','=',null)
        ->count('id');

        $groups = DB::table('client_groups')
        ->where('group_status','=',1)
        ->count();

        $groupClients = DB::table('register_clients')
        ->where('id_group','!=',null)
        ->count('id');  

        return view('home',compact('individualLoans','groupLoans','newIndividualClients','groupClients','groups'));
    }
}

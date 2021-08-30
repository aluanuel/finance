<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $application = $this->countTasks(Auth::user()->usertype,'loan_application');
        $assessment = $this->countTasks(Auth::user()->usertype,'loan_assessments');


        return view('home',compact('individualLoans','groupLoans','newIndividualClients','groupClients','groups','application','assessment'));
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

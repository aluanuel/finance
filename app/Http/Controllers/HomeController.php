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

        return view('home');
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

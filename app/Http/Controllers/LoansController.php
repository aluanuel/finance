<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Clients;
use App\Models\Rates;
use App\Models\Loans;
use App\Models\Transactions;
use App\Models\LoanSchedule;
use DB;
use Auth;

class LoansController extends Controller
{
    
    public function index(Request $request){

        $client = DB::table('clients')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->where('clients.id',$request->id)
                ->select('clients.*','loan_groups.group_name','loan_groups.group_code')
                ->first();

        return view('apply.grp.index',compact('client'));
    }

    public function view_group_loans_list(){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('loans.*','clients.name','clients.telephone','loan_groups.group_name','loan_groups.group_code')
                ->where('loans.loan_status','!=','Completed')
                ->orderBy('date_loan_application','desc')
                ->limit(250)
                ->get();

            return view('apply.grp.group_loan_list',compact('loan'));
    }

    public function view_individual_loans_list(){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->select('loans.*','clients.name','clients.telephone')
                ->where('loans.loan_status','!=','Completed')
                ->where('clients.id_loan_group',null)
                ->orderBy('date_loan_application','desc')
                ->limit(250)
                ->get();
            return view('apply.ind.ind_loan_list',compact('loan'));

    }

    public function new_loan_application(Request $request){

        $check = Loans::where('id_client',$request->id)->latest()->first();

        if(is_null($check) || $check->loan_status == "Completed"){

            $loan_request = $request->loan_request_amount;

            $loan_interest = $request->interest_rate/100 * $loan_request;

            $new_loan = new Loans();

            $new_loan->id_client = $request->id;

            $new_loan->loan_number = $this->generate_loan_number();

            $new_loan->loan_request_amount = $loan_request;

            $new_loan->loan_period = $request->loan_period;

            $new_loan->interest_rate = $request->interest_rate;

            $new_loan->loan_processing_rate = $request->loan_processing_rate;

            $new_loan->date_loan_application = $request->date_loan_application;

            $new_loan->total_loan = ($loan_request + $loan_interest);

            $new_loan->borrowing_purpose = $request->borrowing_purpose;

            $new_loan->collateral_security = $request->collateral_security;

            $new_loan->save();

            return redirect()->back()->with('success','Success');

        }elseif($check->loan_status == "Pending Assessment"){

            return redirect()->back()->with('warning','Loan application '.$check->loan_number.' exists');

        }elseif($check->loan_status == "Approved"){

            return redirect()->back()->with('warning','Loan application '.$check->loan_number.' exists'); 

        }elseif($check->loan_status == "Running"){

            return redirect()->back()->with('error','You have a running loan with us. Clear existing loan first');

        }elseif($check->loan_status == "Defaulted"){

            return redirect()->back()->with('error','You have a defaulted loan with us. Clear existing loan first'); 

        }

    } 

    public function loan_assessment(Request $request){

        $loan_request = Loans::where('id',$request->id)->first();

        $loan_approval = $request->loan_approved;

        $loan_interest = $request->interest_rate/100 * $loan_approval;

        $loan_request->interest_rate = $request->interest_rate;

        $loan_request->loan_period = $request->loan_period;

        $loan_request->loan_approved = $loan_approval;

        $loan_request->total_loan = ($loan_approval + $loan_interest);

        $loan_request->loan_status = $request->loan_status;

        $loan_request->date_loan_approved = $request->date_loan_approved;

        if($loan_request->save()){

            $loan_period = $request->loan_period;

            $schedule = [];

            $days = 7;

            for($i = 1; $i <= $loan_period; $i++){

                $schedule[] = [

                    'instalment_date' => $this->calculate_instalment_date($days),

                    'instalment_amount' => ($loan_request->total_loan)/$loan_period,

                    'id_loan' => $request->id
                ];

                $days += 7;
            }

            LoanSchedule::insert($schedule);

            return redirect()->back()->with('success','Success');
        }

        return redirect()->back()->with('error','Error');
    }

    public function loan_disbursement(Request $request){

        $last_instalment_date = LoanSchedule::where('id_loan',$request->id)->select('instalment_date')->latest()->first();

        $approved = Loans::where('id',$request->id)->first();

        $approved->loan_status = "Running";

        $approved->loan_outstanding = $approved->total_loan;

        $approved->date_loan_disbursed = date('Y-m-d');

        $approved->loan_start_date = date('Y-m-d');

        $approved->loan_end_date = $last_instalment_date->instalment_date;

        $approved->save();

        $record = new Transactions();

        $record->transaction_date = date('Y-m-d');

        $record->transaction_detail = "Loan Processing Fee - ".$approved->loan_number;

        $record->transaction_type = "Income";

        $record->id_loan = $request->id;

        $record->amount = str_replace(',','',$request->loan_processing_fee);

        $record->created_by = Auth::user()->id;

        $record->save();

        return redirect()->back()->with('success','Success');

    }


    public function restore_previous_loan(){

        $groups = DB::table('loan_groups')->get();

        return view('apply.restore.loan.index',compact('groups'));

    }

    public function record_previous_loan(Request $request){

        $client = new Clients();

        $account_number = (\App::call('\App\Http\Controllers\ClientsController@generate_account_number'));

        $client->name = $request->name;

        $client->gender = $request->gender;

        $client->dob = $request->dob;

        $client->telephone = $request->telephone;

        $client->permanent_address = $request->permanent_address;

        $client->account_number = $account_number;

        if(is_int($request->id_loan_group)){

            $client->id_loan_group = $request->id_loan_group;

        }else{

            $client->id_loan_group = null;

        }
        
        $client->save();


        $interest_rate = $request->interest_rate;

        $loan_disbursed = $request->loan_approved;

        $total_loan = ((($interest_rate/100)*$loan_disbursed)+$loan_disbursed);

        $loan_recovered = $request->loan_recovered;

        $loan = new Loans();

        $loan->id_client = $client->id;

        $loan->loan_request_amount = $loan_disbursed;

        $loan->loan_approved = $loan_disbursed;

        $loan->interest_rate = $interest_rate;

        $loan->total_loan = $total_loan;

        $loan->loan_period = $request->loan_period;

        $loan->loan_recovered = $loan_recovered;

        $loan->loan_outstanding = ($total_loan - $loan_recovered);

        $loan->date_loan_application  = $request->date_loan_disbursed;

        $loan->date_loan_disbursed = $request->date_loan_disbursed;

        $loan->loan_status = $request->loan_status;

        $loan->save();

        return redirect()->back()->with('success','Success');

    }

    private function generate_loan_number(){

        $number = Loans::latest()->first();

        if(empty($number)){

            $x = date('Y');

            $loan_number = $x.'0001';

            return $loan_number;

        }else{

            $loan_number = $number->loan_number;

            return $loan_number += 1;

        }

    }

    private function calculate_end_date($weeks){

        $Carbon = Carbon::now();

        $days = $weeks * 7;

        return $Carbon->addDays($days);

    }

    private function calculate_instalment_date($days){

        $dates = Carbon::now();

        return $dates->addDays($days);
        
    }
}

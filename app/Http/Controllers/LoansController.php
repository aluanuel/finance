<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Clients;
use App\Models\Rates;
use App\Models\Loans;
use App\Models\Transactions;
use App\Models\LoanSchedule;
use App\Models\Ledger;
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

    public function view_all_loans(){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->select('loans.*','clients.name','clients.telephone')
                ->where('loans.loan_status','!=','Completed')
                ->orderBy('date_loan_application','desc')
                ->get();
        $heading = "View all loans"; 

            return view('apply.loans.view_all_loans',compact('loan','heading'));
    }

    public function search_all_loans(Request $request){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->select('loans.*','clients.name','clients.telephone')
                ->where('loans.loan_status',$request->id)
                ->orderBy('date_loan_application','desc')
                ->get();
        $heading = "View ".strtolower($request->id)." loans"; 

        return view('apply.loans.view_all_loans',compact('loan','heading'));;
    }

    public function view_group_loans_list(){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('loans.*','clients.name','clients.telephone','loan_groups.group_name','loan_groups.group_code')
                ->where('loans.loan_status','!=','Completed')
                ->orderBy('date_loan_application','desc')
                ->limit(200)
                ->get();

            return view('apply.grp.group_loan_list',compact('loan'));
    }

    public function loan_search(Request $request){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('loans.*','clients.name','clients.telephone','loan_groups.group_name','loan_groups.group_code')
                ->where('clients.name','like','%'.$request->name.'%')
                ->orWhere('loans.loan_number','like','%'.$request->name.'%')
                ->orWhere('loan_groups.group_name','like','%'.$request->name.'%')
                ->where('loans.loan_status','!=','Completed')
                ->orderBy('date_loan_application','desc')
                ->get();

            return view('apply.grp.group_loan_list',compact('loan'));

    }

    public function view_individual_loans(){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->select('loans.*','clients.name','clients.telephone')
                ->where('loans.loan_status','!=','Completed')
                ->whereNull('clients.id_loan_group')
                ->orderBy('date_loan_application','desc')
                ->get();

        $heading = "View individual loans"; 
        
        return view('apply.loans.view_individual_loans',compact('loan','heading'));

    }

    public function search_individual_loans(Request $request){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->select('loans.*','clients.name','clients.telephone')
                ->where('loans.loan_status',$request->id)
                ->whereNull('clients.id_loan_group')
                ->orderBy('date_loan_application','desc')
                ->get();

        $heading = "View ".strtolower($request->id)." loans"; 
        
        return view('apply.loans.view_individual_loans',compact('loan','heading'));

    }



    public function view_group_loans(){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('loans.*','clients.name','clients.telephone','loan_groups.group_name','loan_groups.group_code')
                ->where('loans.loan_status','!=','Completed')
                ->orderBy('date_loan_application','desc')
                ->get();

        $heading = "View group loans"; 

        return view('apply.loans.view_group_loans',compact('loan','heading'));

    }

    public function search_group_loans(Request $request){

        $loan = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('loans.*','clients.name','clients.telephone','loan_groups.group_name','loan_groups.group_code')
                ->where('loans.loan_status',$request->id)
                ->orderBy('date_loan_application','desc')
                ->get();

        $heading = "View ".strtolower($request->id)." loans"; 

        return view('apply.loans.view_group_loans',compact('loan','heading'));

    }

    public function new_loan_application(Request $request){

        $check = Loans::where('id_client',$request->id)->latest()->first();

        if(is_null($check) || $check->loan_status == "Completed"){

                $loan_request = str_replace(',','',$request->loan_request_amount);

                $loan_interest = $request->interest_rate/100 * $loan_request;

                $new_loan = new Loans();

                $new_loan->id_client = $request->id;

                $new_loan->id_loan_product = $request->id_loan_product;

                $new_loan->loan_number = $this->generate_loan_number();

                $new_loan->loan_request_amount = $loan_request;

                $new_loan->loan_period = str_replace(',','',$request->loan_period);

                $new_loan->interest_rate = $request->interest_rate;

                $new_loan->loan_processing_rate = $request->loan_processing_rate;

                $new_loan->interest_on_defaulting = $request->interest_on_defaulting;

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

        $loan_approval = str_replace(',','',$request->loan_approved);

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

        $loan_disbursement = [
                                [
                                    'transaction_date' => Carbon::now(),

                                    'transaction_detail' => "Loan Processing Fee - ".$approved->loan_number,

                                    'transaction_type' => "Income",

                                    'id_loan' => $request->id,

                                    'amount' => str_replace(',','',$request->loan_processing_fee),

                                    'created_by' => Auth::user()->id,

                                    'created_at' =>Carbon::now()
                                ],
                                [
                                    'transaction_date' => Carbon::now(),

                                    'transaction_detail' => "Loan disbursement - ".$approved->loan_number,
                                    'transaction_type' => 'Expense',

                                    'id_loan' => $request->id,

                                    'amount' => str_replace(',','',$approved->loan_approved),

                                    'created_by' => Auth::user()->id,

                                    'created_at' => Carbon::now()
                                ]
                            ];

            $result = Transactions::insert($loan_disbursement);

            if($result){

                $last_transaction = Transactions::latest()->first();

                $entry = new Ledger();

                $entry->id_transaction = $last_transaction->id;

                $entry->id_loan = $approved->id;

                $entry->id_client = $approved->id_client;

                $entry->loan_approved = $approved->loan_approved;

                $entry->total_loan = $approved->total_loan;

                $entry->date_loan_disbursed = date('Y-m-d');

                $entry->loan_status = "Running";

                $entry->loan_recovered = 0;

                $entry->loan_outstanding = $approved->total_loan;

                $entry->save();
            }

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

        $client->id_loan_group = $request->id_loan_group;
        
        $client->save();


        $interest_rate = $request->interest_rate;

        $loan_disbursed = $request->loan_approved;

        $total_loan = ((($interest_rate/100)*$loan_disbursed)+$loan_disbursed);

        $loan_recovered = $request->loan_recovered;

        $loan = new Loans();

        $rates = Rates::where('rate_type','Interest on Loan Defaulting')->latest()->first();

        $loan->id_client = $client->id;

        $loan->loan_number = 10101010;

        $loan->loan_request_amount = $loan_disbursed;

        $loan->loan_approved = $loan_disbursed;

        $loan->interest_rate = $interest_rate;

        $loan->interest_on_defaulting = $rates->rate;

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

        $number = Loans::max('loan_number');

        $x = date('Y');

        if($number){

            if($number == 10101010){

                $number = $x.'0001';

                return $number;

            }else{

                return $number += 1;

            }

        }else{

             $number = $x.'0001';

             return $number;

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

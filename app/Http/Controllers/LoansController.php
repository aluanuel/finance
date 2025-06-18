<?php

namespace App\Http\Controllers;

use App\Models\Clients;

use App\Models\Rates;

use App\Models\Loans;

use App\Models\Transactions;

use DB;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
                ->get();

            return view('apply.grp.group_loan_list',compact('loan'));
    }

    public function new_group_loan_application(Request $request){

        $check = Loans::where('id',$request->id)->latest()->first();

        if(is_null($check)){

            $loan_request = $request->loan_request_amount;

            $loan_interest = $request->interest_rate/100 * $loan_request;

            $new_loan = new Loans();

            $new_loan->id_client = $request->id;

            $new_loan->loan_number = $this->generate_loan_number();

            $new_loan->loan_request_amount = $loan_request;

            $new_loan->loan_period = $request->loan_period;

            $new_loan->interest_rate = $request->interest_rate;

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

        $loan_request->save();

        return redirect()->back()->with('success','Success');
    }

    public function loan_disbursement(Request $request){

        $approved = Loans::where('id',$request->id)->first();

        $approved->loan_status = "Running";

        $approved->loan_outstanding = $approved->total_loan;

        $approved->date_loan_disbursed = date('Y-m-d');

        $approved->date_loan_fully_recovered = $this->calculate_end_date($approved->loan_period);

        $approved->save();

        $record = new Transactions();

        $record->transaction_detail = "Loan Processing Fee";

        $record->transaction_type = "Income";

        $record->id_loan = $request->id;

        $record->amount = str_replace(',','',$request->loan_processing_fee);

        $record->created_by = Auth::user()->id;

        $record->save();

        return redirect()->back()->with('success','Success');

    }

    private function generate_loan_number(){

        $number = Loans::latest()->first();

        if(is_null($number)){

            $x = date('Y');

            $loan_number = $x.'0001';

            return $loan_number;

        }
            $loan_number = $number->loan_number;

            return $loan_number++;

    }

    private function calculate_end_date($weeks){

        $Carbon = Carbon::now();

        $days = $weeks * 7;

        return $Carbon->addDays($days);

    }
}

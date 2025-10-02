<?php

namespace App\Http\Controllers;
use App\Models\Transactions;
use App\Models\Loans;
use Carbon\Carbon;
use DB;
use Auth;

use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(){

        $transaction = Transactions::orderBy('created_at','desc')->limit(500)->get();

        return view('apply.transactions.teller.index',compact('transaction'));
    }

    public function view_loan_repayments(){

        $loans = DB::table('loans')
                ->join('clients','loans.id_client','clients.id')
                ->join('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('loans.*','clients.id as id_client','clients.name','clients.telephone','loan_groups.group_name')
                ->where('loans.loan_status','Running')
                ->orWhere('loans.loan_status','Defaulted')
                ->get();

        return view('apply.report.teller.view_loan_repayments',compact('loans'));
    }

    public function create_loan_repayment_entry(Request $request){

        $loan = Loans::where('id',$request->id)->first();

        $entry = new Transactions();

        $entry->transaction_detail = "Loan Repayment - ".$loan->loan_number;

        $entry->transaction_type = "Income";

        $entry->id_client = $loan->id_client;

        $entry->id_loan = $loan->id;

        $entry->amount = $request->loan_repayment;

        $entry->transaction_date = $request->repayment_date;

        $entry->created_by = Auth::user()->id;

        $entry->save();

        $loan->loan_recovered = $this->calculate_loan_recovered($loan->loan_recovered, $request->loan_repayment);

        $loan_outstanding = $this->calculate_loan_outstanding($loan->loan_outstanding,$request->loan_repayment);

        $loan->loan_outstanding = $loan_outstanding;

        if($loan_outstanding == 0){

            $loan->date_loan_fully_recovered = date('Y-m-d');

            $loan->loan_status = "Completed";

            $loan->save();

        }else{

            $loan->save();
        }

        return redirect()->back()->with('success','Success');

    }

        public function reinstate_loan(Request $request){

        $loan = Loans::where('id',$request->id)->first();

        $loan_outstanding = str_replace(',','',$request->loan_outstanding);

        // $total_loan_outstanding = str_replace(',','',$request->total_loan_outstanding);

        $amount = str_replace(',','',$request->amount);

        $penalty = str_replace(',','',$request->penalty_on_defaulting);

        $loan_recovered = $amount - $penalty;

        $new_loan_outstanding = $loan_outstanding - $loan_recovered;


        if(($amount - $penalty) >= 0){


            $trans = new Transactions();

            $trans->transaction_detail = "Penalty (default) - ".$loan->loan_number;

            $trans->transaction_type = "Income";

            $trans->id_client = $loan->id_client;

            $trans->id_loan = $loan->id;

            $trans->amount = $penalty;

            $trans->transaction_date = Carbon::today();

            $trans->created_by = Auth::user()->id;

            $trans->save();

            

            $entry = new Transactions();

            $entry->transaction_detail = "Loan Repayment - ".$loan->loan_number;

            $entry->transaction_type = "Income";

            $entry->id_client = $loan->id_client;

            $entry->id_loan = $loan->id;

            $entry->amount = $loan_recovered;

            $entry->transaction_date = Carbon::today();

            $entry->created_by = Auth::user()->id;

            $entry->save();


            $loan->loan_recovered = $loan_recovered;

            $loan->loan_outstanding = $new_loan_outstanding;

            if($new_loan_outstanding <= 0){

                $loan->date_loan_fully_recovered = date('Y-m-d');

                $loan->loan_status = "Completed";

            }else{

                $loan->loan_status = "Running";

            }

                $loan->save();



            return redirect()->back()->with('success','Success');

        }else{

            return redirect()->back()->with('error','Error! Deposit amount is less than the penalty');
        }

    }

    public function create_new_transaction_entry(Request $request){

            $entry = new Transactions();

            $entry->transaction_detail = $request->transaction_detail;

            $entry->transaction_type = $request->transaction_type;

            $entry->amount = str_replace(',','',$request->amount);

            $entry->transaction_date = $request->transaction_date;

            $entry->created_by = Auth::user()->id;

            $entry->save();

        return redirect()->back()->with('success','Success');

    }

    private function calculate_loan_recovered($recovery,$repayment){

        return ($recovery + $repayment);

    }

    private function calculate_loan_outstanding($loan_outstanding,$repayment){

        return ($loan_outstanding - $repayment);
    }

}

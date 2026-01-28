<?php

namespace App\Http\Controllers;
use App\Models\Transactions;
use App\Models\Loans;
use App\Models\Ledger;
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

        $loan_repayment = str_replace(',','',$request->loan_repayment);

        $date_loan_fully_recovered = null;

        $entry = new Transactions();

        $transaction_detail = "Loan Repayment - ".$loan->loan_number;

        $transaction_type = "Income";

        $id_client = $loan->id_client;

        $id_loan = $loan->id;

        $transaction_date = $request->repayment_date;

        $created_by = Auth::user()->id;


        $entry = Transactions::where('id_client',$id_client)->where('transaction_detail',$transaction_detail)->where('transaction_date',$transaction_date)->where('amount',$loan_repayment)->latest()->first();

        if($entry){

            return redirect()->back()->with('error','Duplicate entry forbidden');

        }else{

            $entry = new Transactions();

            $entry->transaction_detail = $transaction_detail;

            $entry->transaction_type = "Income";

            $entry->id_client = $id_client;

            $entry->id_loan = $loan->id;

            $entry->amount = $loan_repayment;

            $entry->transaction_date = $transaction_date;

            $entry->created_by = Auth::user()->id;

            $entry->save();

            $loan->loan_recovered = $this->calculate_loan_recovered($loan->loan_recovered, $loan_repayment);

            $loan_outstanding = $this->calculate_loan_outstanding($loan->loan_outstanding,$loan_repayment);

            $loan->loan_outstanding = $loan_outstanding;

            if($loan_outstanding == 0){

                $date_loan_fully_recovered = date('Y-m-d');

                $loan_status = "Completed";

                $loan->date_loan_fully_recovered = $date_loan_fully_recovered;

                $loan->loan_status = $loan_status;

                $loan->save();

            }else{

                $loan->save();
            }

            $ledger = new Ledger();

            $ledger->id_transaction = $entry->id;

            $ledger->id_loan = $entry->id_loan;

            $ledger->id_client = $entry->id_client;

            $ledger->loan_approved = $loan->loan_approved;

            $ledger->total_loan = $loan->total_loan;

            $ledger->date_loan_disbursed = $loan->date_loan_disbursed;

            $ledger->date_loan_fully_recovered = $date_loan_fully_recovered;

            $ledger->loan_status = $loan->loan_status;

            $ledger->loan_recovered = $loan->loan_recovered;

            $ledger->loan_outstanding = $loan->loan_outstanding;

            $ledger->save();

                return redirect()->back()->with('success','Success');
        }

    }


    public function update_transaction_entry(Request $request){

        $id_transaction = $request->id;

        $amount = str_replace(',','',$request->amount);

        $transaction_detail = explode('-',$request->transaction_detail);

        $transaction = Transactions::where('id',$id_transaction)->first();

        if($transaction){

            $amount = str_replace(',','',$request->amount);

            // dd($transaction);

            if($transaction_detail[0] == 'Loan Repayment '){

                $recent_transaction = $transaction->amount;

                $loans = Loans::where('id',$transaction->id_loan)->first();

                $ledger = Ledger::where('id_transaction',$id_transaction)->first();

                $transaction->amount = $amount;

                $transaction->save();

                $previous_loan_balance = ($recent_transaction + $loans->loan_outstanding);

                $previous_loan_recovered = ($loans->total_loan - $previous_loan_balance);

                $new_loan_recoverd = $previous_loan_recovered + $amount;

                $new_loan_balance = $loans->total_loan - $new_loan_recoverd;

                $loans->loan_outstanding = $new_loan_balance;

                $loans->loan_recovered = $new_loan_recoverd;

                if($new_loan_balance <= 0){

                    $loans->loan_status = "Completed";

                    $ledger->loan_status = "Completed";
                }else{

                    $loans->loan_status = "Running";

                    $ledger->loan_status = "Running";

                }

                $loans->save();


                $ledger->loan_outstanding = $new_loan_balance;

                $ledger->loan_recovered = $new_loan_recoverd;

                $ledger->save();


            }else{

                return redirect()->back()->with('error','Transaction update failed. Consult your system administrator for help');

            }

            return redirect()->back()->with('success','Success');

        }
        return redirect()->back()->with('error','Transaction record not found');
        
    }

    public function reinstate_loan(Request $request){

        $loan = Loans::where('id',$request->id)->first();

        $loan_outstanding = str_replace(',','',$request->loan_outstanding);

        $total_loan_outstanding = str_replace(',','',$request->total_loan_outstanding);

        $amount = str_replace(',','',$request->amount);

        $penalty = $amount - $loan_outstanding;


        if($amount >= $total_loan_outstanding){

            $entry = new Transactions();

            $entry->transaction_detail = "Loan Repayment - ".$loan->loan_number;

            $entry->transaction_type = "Income";

            $entry->id_client = $loan->id_client;

            $entry->id_loan = $loan->id;

            $entry->amount = $amount;

            $entry->transaction_date = Carbon::today();

            $entry->created_by = Auth::user()->id;

            $entry->save();


            $loan->loan_recovered = $loan_outstanding;

            $loan->loan_outstanding = 0;

            $loan->date_loan_fully_recovered = date('Y-m-d');

            $loan->loan_status = "Completed";

            $loan->save();

            $trans = new Transactions();

            $trans->transaction_detail = "Penalty (default) - ".$loan->loan_number;

            $trans->transaction_type = "Income";

            $trans->id_client = $loan->id_client;

            $trans->id_loan = $loan->id;

            $trans->amount = $penalty;

            $trans->transaction_date = Carbon::today();

            $trans->created_by = Auth::user()->id;

            $trans->save();

            return redirect()->back()->with('success','Success');

        }else{

            $entry = new Transactions();

            $entry->transaction_detail = "Loan Repayment - ".$loan->loan_number;

            $entry->transaction_type = "Income";

            $entry->id_client = $loan->id_client;

            $entry->id_loan = $loan->id;

            $entry->amount = $amount;

            $entry->transaction_date = Carbon::today();

            $entry->created_by = Auth::user()->id;

            $entry->save();

            $loan->loan_recovered = $this->calculate_loan_recovered($loan->loan_recovered, $amount);

            $outstanding = $this->calculate_loan_outstanding($loan->loan_outstanding,$amount);

            $loan->loan_outstanding = $outstanding;

            if($outstanding == 0){

                $loan->date_loan_fully_recovered = date('Y-m-d');

                $loan->loan_status = "Completed";

                $loan->save();

            }else{

                $loan->loan_status = "Running";

                $loan->save();
            }

            return redirect()->back()->with('success','Success');
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

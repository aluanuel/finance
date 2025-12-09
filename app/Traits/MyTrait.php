<?php

namespace App\Traits;

use DB;

trait MyTrait
{

	public function recent_target_recovery($start_date,$end_date,$id_loan_group){

                $target_recovery = DB::table('loans')
                        ->join('clients','loans.id_client','clients.id')
                        ->where('clients.id_loan_group',$id_loan_group)
                        ->where('loans.loan_status','Running')
                        ->orWhere('clients.id_loan_group',$id_loan_group)
                        ->where('loans.loan_status','Defaulted')
                        ->sum('loans.instalment_amount');

                return $target_recovery;

        }

    public function recent_actual_recovery($start_date,$end_date,$id_loan_group){

                $actual_recovery = DB::table('transactions')
                                        ->join('loans','transactions.id_loan','loans.id')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->where('clients.id_loan_group',$id_loan_group)
                                        ->where('transactions.transaction_detail','like','%Loan Repayment%')
                                        ->whereBetween('transactions.transaction_date',[$start_date,$end_date])
                                        ->sum('transactions.amount');

                return $actual_recovery;
    }

    public function date_first_loan_issued_using_this_app(){

        $start = DB::table('loans')
                ->where('loan_number','20250001')
                ->select('date_loan_disbursed')
                ->first();

        return $start->date_loan_disbursed;

    }
}
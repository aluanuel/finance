<?php

namespace App\Traits;

use DB;

use Carbon\Carbon;

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

    public function date_first_transaction_using_this_app($transaction_detail){

        $first = DB::table('transactions')->where('transaction_detail','like','%'.$transaction_detail.'%')->orderBy('transaction_date','asc')->first();

        return $first->transaction_date;

    }

     public function deficit_in_loan_recovery($end_of_week = null, $loan_end_date,$instalment_amount,$total_loan,$loan_recovered){

            $now = Carbon::parse($end_of_week);

            $end_date = Carbon::parse($loan_end_date);

        $number_of_weeks = $now->diffInWeeks($end_date);

        if( $now->gt($end_date) || $number_of_weeks == 0 ){

            return ($total_loan - $loan_recovered);

        }else{

            $remaining_instalment = ($instalment_amount * $number_of_weeks);

            return $total_loan - ($remaining_instalment + $loan_recovered);

        }
        // return $number_of_weeks;

    }
}
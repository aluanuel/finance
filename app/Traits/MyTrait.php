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

     // public function deficit_in_loan_recovery($end_of_week = null, $loan_end_date,$instalment_amount,$total_loan,$loan_recovered){

     //        $now = Carbon::parse($end_of_week);

     //        $end_date = Carbon::parse($loan_end_date);

     //    $number_of_weeks = $now->diffInWeeks($end_date);

     //    if( $now->gt($end_date) || $number_of_weeks == 0 ){

     //        return ($total_loan - $loan_recovered);

     //    }else{

     //        $remaining_instalment = ($instalment_amount * $number_of_weeks);

     //        return $total_loan - ($remaining_instalment + $loan_recovered);

     //    }
        // return $number_of_weeks;

    // }

    public function upfront_outstanding_balance($instalment_amount,$weeks_upfront){

        return $instalment_amount * $weeks_upfront;

    }

    public function deficit_in_loan_recovery($upfront_balance,$total_loan,$total_recovery){

        return $total_loan - ($upfront_balance + $total_recovery);
    }

        public function single_group_loan_recovery($start_date,$end_date,$id_loan_group,$loan_status){

            $group_members = DB::table('clients')->where('id_loan_group',$id_loan_group)->get();

            $i = 0;

            // retrieve recent loans taken by all clients

            $member_loan = []; $single_member_loan = []; $single_member_loan_details = [];

            foreach($group_members as $member){

                $loan_taken = DB::table('loans')
                            ->where('id_client',$member->id)
                            ->where('loan_status',$loan_status)
                            ->latest()->first();

                if($loan_taken){

                        $member_loan[$i] = [
                        "id_loan" => $loan_taken->id,
                        "name" => $member->name,
                        "instalment_amount" => $loan_taken->instalment_amount,
                        "total_loan" => $loan_taken->total_loan,
                        "loan_recovered" => $loan_taken->loan_recovered,
                        "loan_outstanding" => $loan_taken->loan_outstanding,
                        "loan_status" => $loan_taken->loan_status,
                        "loan_end_date"=>$loan_taken->loan_end_date
                    ];

                    $i++;
                }            

            }

            // dd($member_loan);

            for($j = 0; $j < sizeof($member_loan); $j++){ 

                $person = $member_loan[$j];

                $recovery = DB::table('transactions')
                        ->where('transaction_detail','like','%Loan Repayment%')
                        ->where('id_loan',$person['id_loan'])
                        ->whereBetween('transaction_date',[$start_date,$end_date])
                        ->latest()->first();

                if($recovery){

                    $loan_recovery[$j] = [
                        "amount"=>$recovery->amount,
                        "created_at"=>$recovery->transaction_date
                    ];

                }else{
                    $loan_recovery[$j] = [
                        "amount"=> 0,
                        "created_at"=>$end_date
                    ];
                }     

            }

            dd(array_combine($member_loan,$loan_recovery));


            for($j = 0; $j < sizeof($member_loan); $j++){ 

                $recovery = $loan_recovery[$j];

                $person = $member_loan[$j];

                if(is_null($person['loan_end_date'])){

                    $loan_end_date = Carbon::now()->toDateString();

                }else{

                    $loan_end_date = $person['loan_end_date'];

                }

                $end_date = Carbon::parse($loan_end_date);


                if(strtotime(Carbon::now()->toDateString()) - strtotime($end_date) >= 0 ){

                    $difference_in_weeks = 0;

                }else{

                    $difference_in_weeks = $end_date->diffInWeeks(Carbon::now()->toDateString());

                }

                $single_member_loan[$j] = [

                    "id_loan" => $person['id_loan'],
                    "name" => $person['name'],
                    "instalment_amount" => $person['instalment_amount'],
                    "total_loan" => $person['total_loan'],
                    "loan_recovered" => $person['loan_recovered'],
                    "loan_outstanding" => $person['loan_outstanding'],
                    "loan_status" => $person['loan_status'],
                    "loan_end_date"=>$loan_end_date,
                    "weeks_remaining" => $difference_in_weeks,
                    "amount" => $recovery['amount'],
                    "created_at" => $recovery['created_at']
                ];

            }

            for($k = 0; $k < sizeof($single_member_loan); $k ++){

                $mem = $single_member_loan[$k];


                $single_member_loan_details[$k] = [

                    "id_loan" => $mem['id_loan'],
                    "name" => $mem['name'],
                    "instalment_amount" => $mem['instalment_amount'],
                    "total_loan" => $mem['total_loan'],
                    "loan_recovered" => $mem['loan_recovered'],
                    "loan_outstanding" => $mem['loan_outstanding'],
                    "loan_status" => $mem['loan_status'],
                    "loan_end_date"=>$mem['loan_end_date'],
                    "weeks_remaining" => $mem['weeks_remaining'],
                    "amount" => $mem['amount'],
                    "created_at" => $mem['created_at'],
                    "deficit_loan_recovery" => $this->deficit_in_loan_recovery($this->upfront_outstanding_balance($mem['instalment_amount'],$mem['weeks_remaining']),$mem['total_loan'],$mem['loan_recovered'])
                ];
            }

            return $single_member_loan_details;

    }
}
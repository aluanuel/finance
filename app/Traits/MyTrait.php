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
}
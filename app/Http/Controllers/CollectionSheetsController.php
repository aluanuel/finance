<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;
use Auth;

class CollectionSheetsController extends Controller
{
    public function view_collection_sheet(){

        $schedule = DB::table('loans')
                        ->join('clients','loans.id_client','clients.id')
                        ->join('loan_schedules','loans.id','loan_schedules.id_loan')
                        ->select('clients.name','clients.telephone','loans.*','loan_schedules.*')
                        ->where('loan_schedules.instalment_date',Carbon::now()->toDateString())
                        ->where('loans.loan_status','!=','Completed')
                        ->get();

        $collection = array();

        $i = 0;

        foreach($schedule as $sch ){

            $transaction = DB::table('transactions')->where('transaction_detail','like','%Loan Repayment%')->where('transaction_date',$period)->latest()->first();
            if($transaction){

                $collection[$i] = ["loan_number" => $sch->loan_number,
                                    "name" => $sch->name,
                                    "telephone" => $sch->telephone,
                                    "total_loan" => $sch->total_loan,
                                    "loan_outstanding" => $sch->loan_outstanding,
                                    "instalment_amount" => $sch->instalment_amount,
                                    "amount" => $transaction->amount
                                ];
            }else{

                $collection[$i] = ["loan_number" => $sch->loan_number,
                                    "name" => $sch->name,
                                    "telephone" => $sch->telephone,
                                    "total_loan" => $sch->total_loan,
                                    "loan_outstanding" => $sch->loan_outstanding,
                                    "instalment_amount" => $sch->instalment_amount,
                                    "amount" => 0
                                ];

            }

            $i++;
        }

        $heading = "View collection sheet for ".Carbon::now()->format('F d, Y');

        return view('apply.sheets.view_collection_sheet',compact('collection','heading'));
    }

    public function search_collection_sheet(Request $request){

        $period = $request->period;

        $collection = array();

        $i = 0;

        switch($request->category){

            case 'All collection':

                                $schedule = DB::table('loans')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->join('loan_schedules','loans.id','loan_schedules.id_loan')
                                        ->select('clients.name','clients.telephone','loans.*','loan_schedules.*')
                                        ->where('loan_schedules.instalment_date',$period)
                                        ->where('loans.loan_status','!=','Completed')
                                        ->get();

                                foreach($schedule as $sch ){

                                    $transaction = DB::table('transactions')->where('transaction_detail','like','%Loan Repayment%')->where('transaction_date',$period)->latest()->first();
                                    if($transaction){

                                        $collection[$i] = ["loan_number" => $sch->loan_number,
                                                            "name" => $sch->name,
                                                            "telephone" => $sch->telephone,
                                                            "total_loan" => $sch->total_loan,
                                                            "loan_outstanding" => $sch->loan_outstanding,
                                                            "instalment_amount" => $sch->instalment_amount,
                                                            "amount" => $transaction->amount
                                                        ];
                                    }else{

                                        $collection[$i] = ["loan_number" => $sch->loan_number,
                                                            "name" => $sch->name,
                                                            "telephone" => $sch->telephone,
                                                            "total_loan" => $sch->total_loan,
                                                            "loan_outstanding" => $sch->loan_outstanding,
                                                            "instalment_amount" => $sch->instalment_amount,
                                                            "amount" => 0
                                                        ];

                                    }

                                    $i++;
                                }

                                $heading = "View all collections for ".date('F d, Y',strtotime($period));

                break;

                case 'Missed repayment':

                                $schedule = DB::table('loans')
                                        ->join('clients','loans.id_client','clients.id')
                                        ->join('loan_schedules','loans.id','loan_schedules.id_loan')
                                        ->select('clients.name','clients.telephone','loans.*','loan_schedules.*')
                                        ->where('loan_schedules.instalment_date',$period)
                                        ->where('loans.loan_status','!=','Completed')
                                        ->get();

                                foreach($schedule as $sch ){

                                    $transaction = DB::table('transactions')->where('transaction_detail','like','%Loan Repayment%')->where('transaction_date',$period)->latest()->first();
                                    if(is_null($transaction)){

                                        $collection[$i] = ["loan_number" => $sch->loan_number,
                                                            "name" => $sch->name,
                                                            "telephone" => $sch->telephone,
                                                            "total_loan" => $sch->total_loan,
                                                            "loan_outstanding" => $sch->loan_outstanding,
                                                            "instalment_amount" => $sch->instalment_amount,
                                                            "amount" => 0
                                                        ];
                                    }

                                    $i++;
                                }

                                $heading = "View missed repayments for ".date('F d, Y',strtotime($period));


                break;
        }


        return view('apply.sheets.view_collection_sheet',compact('collection','heading'));
    }
}

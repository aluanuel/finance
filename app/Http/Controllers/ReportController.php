<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function Collections(){
        $loan = DB::table('loan_repayments')->sum('deposit');
        $heading = "Showing Collections for ".Carbon::now()->toDateString();
    	return view('apply.report.collections',compact('loan','heading'));
    }

    public function Sales(){
    	$sales = DB::table('loan_applications')
    	->where('loan_status','=','started')
    	->orderBy('start_date','desc')
        ->limit(100)
    	->get();
    	return view('apply.report.sales',compact('sales'));
    }

    public function Incomes(){
        $incomes = DB::table('other_payments')
        ->where('payment_category','=','income')
        ->orderBy('created_at','desc')
        ->limit(50)
        ->get();
        $headIncome = 'Showing Recent Incomes';
        return view('apply.report.incomes',compact('incomes','headIncome'));
    }

    public function Expenses(){
        $expenses = DB::table('other_payments')
        ->where('payment_category','=','expense')
        ->orderBy('created_at','desc')
        ->limit(50)
        ->get();
        $headExpense = 'Showing Recent Expenses';
        return view('apply.report.expenses',compact('expenses','headExpense'));
    }

    public function CashBook(){
        $heading = "Showing cashbook for ".Carbon::now()->toDateString();
        return view('apply.report.cashbook',compact('heading'));
    }

    public function BalanceSheet(){
        return view('apply.report.balancesheet');
    }

    public function SearchIncome(){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $incomes = DB::table('other_payments')
        ->where('payment_category','=','income')
        ->whereBetween('created_at',[$start_date,$end_date])
        ->orderBy('created_at','desc')
        ->get();
        $headIncome = 'Showing Incomes Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.incomes', compact('incomes','headIncome'));
    }

    public function SearchExpense(){
        $start_date = Carbon::create(request('start_date'))->toDateTimeString();
        $end = Carbon::create(request('end_date'));

        $end_date = $end->addHours(23)->toDateTimeString();

        $expenses = DB::table('other_payments')
        ->where('payment_category','=','expense')
        ->whereBetween('created_at',[$start_date,$end_date])
        ->orderBy('created_at','desc')
        ->get();
        $headExpense = 'Showing Expenses Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

        return view('apply.report.expenses', compact('expenses','headExpense'));
    }

}

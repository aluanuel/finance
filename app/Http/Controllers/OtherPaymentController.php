<?php

namespace App\Http\Controllers;
use \App\Models\OtherPayment;
use App\Models\TransactionCategory;
use App\Models\TransactionSubCategory;
use Carbon\Carbon;

use DB;


class OtherPaymentController extends Controller {
	public function index() {

		$income =  DB::table('other_payments')
					->join('transaction_categories','other_payments.id_category','transaction_categories.id')
					->where('other_payments.transaction_type', '=', 'income')
					->orderBy('other_payments.created_at', 'desc')
					->limit(25)
					->get();

		$headIncome = 'Showing Recent Incomes';

		$inflow = TransactionCategory::where('transaction_type','income')->get();

		$inflow_sub = TransactionSubCategory::where('transaction_type','income')->get();

		$outflow = TransactionCategory::where('transaction_type','expense')->get();

		$outflow_sub = TransactionSubCategory::where('transaction_type','expense')->get();

		$expense = DB::table('other_payments')
					->join('transaction_categories','other_payments.id_category','transaction_categories.id')
					->where('other_payments.transaction_type', 'expense')
					->orderBy('other_payments.created_at', 'desc')
					->limit(25)
					->get();

		$headExpense = 'Showing Recent Expenses';

		return view('apply.trans.record_transaction', compact('income', 'expense','headIncome','headExpense','inflow','inflow_sub','outflow','outflow_sub'));
	}

	public function recordTransaction() {
		$pay = new OtherPayment();
		$pay->id_category = request('id_category');
		if(is_numeric(request('id_sub_category'))){
			$pay->id_sub_category = request('id_sub_category');
		}else{
			$pay->id_sub_category = null;
		}
		
		$pay->transaction_type = request('transaction_type');
		$pay->transaction_amount = str_replace(',','',request('transaction_amount'));
		$pay->recorded_by = request('recorded_by');
		$pay->save();
		return redirect()->back()->with('success', 'Transaction successful');
	}

	public function SearchIncome(){
		$start_date = Carbon::create(request('start_date'))->toDateTimeString();
		$end = Carbon::create(request('end_date'));

		$end_date = $end->addHours(23)->toDateTimeString();

		$income = OtherPayment::where('payment_category','=','income')
		->whereBetween('created_at',[$start_date,$end_date])
		->orderBy('created_at','desc')
		->get();
		$headIncome = 'Showing Incomes Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

		$expense = OtherPayment::where('payment_category', '=', 'expense')
			->orderBy('created_at', 'desc')
			->limit(100)
			->get();
		$headExpense = 'Showing Recent Expenses';

		return view('apply.trans.record_transaction', compact('income', 'expense','headIncome','headExpense'));
	}

	public function SearchExpense(){
		$start_date = Carbon::create(request('start_date'))->toDateTimeString();
		$end = Carbon::create(request('end_date'));

		$end_date = $end->addHours(23)->toDateTimeString();

		$expense = OtherPayment::where('payment_category','=','expense')
		->whereBetween('created_at',[$start_date,$end_date])
		->orderBy('created_at','desc')
		->get();
		$headExpense = 'Showing Expenses Between ' . Carbon::create($start_date)->toFormattedDateString() . ' To ' . Carbon::create($end_date)->toFormattedDateString();

		$income = OtherPayment::where('payment_category', '=', 'income')
			->orderBy('created_at', 'desc')
			->limit(100)
			->get();
		$headIncome = 'Showing Recent Expenses';

		return view('apply.trans.record_transaction', compact('income', 'expense','headIncome','headExpense'));
	}
}

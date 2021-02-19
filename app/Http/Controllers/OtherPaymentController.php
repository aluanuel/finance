<?php

namespace App\Http\Controllers;
use \App\Models\OtherPayment;
use Carbon\Carbon;

class OtherPaymentController extends Controller {
	public function index() {

		$income = OtherPayment::where('payment_category', '=', 'income')
			->orderBy('created_at', 'desc')
			->limit(25)
			->get();

		$headIncome = 'Showing Recent Incomes';

		$expense = OtherPayment::where('payment_category', '=', 'expense')
			->orderBy('created_at', 'desc')
			->limit(25)
			->get();

		$headExpense = 'Showing Recent Expenses';

		return view('apply.trans.record_transaction', compact('income', 'expense','headIncome','headExpense'));
	}

	public function recordTransaction() {
		$pay = new OtherPayment();
		$pay->payment_name = request('payment_name');
		$pay->payment_amount = request('payment_amount');
		$pay->payment_category = request('payment_category');
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

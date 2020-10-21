<?php

namespace App\Http\Controllers;
use \App\Models\OtherPayment;

class OtherPaymentController extends Controller {
	public function index() {

		$income = OtherPayment::where('payment_category', '=', 'income')
			->orderBy('created_at', 'desc')
			->limit(100)
			->get();

		$expense = OtherPayment::where('payment_category', '=', 'expense')
			->orderBy('created_at', 'desc')
			->limit(100)
			->get();

		return view('apply.trans.record_transaction', compact('income', 'expense'));
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
}

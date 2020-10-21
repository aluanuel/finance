<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use \App\Models\InterestOnLoan;

class InterestOnLoanController extends Controller {
	public function index() {
		$interest = DB::table('interest_on_loans')
			->select('*')
			->orderBy('created_at', 'desc')
			->get();
		return view('apply.settings.interest.index', compact('interest'));
	}

	public function create() {
		$interest = new InterestOnLoan();
		$interest->loan_type = request('loan_type');
		$interest->interest_rate = request('interest_rate') / 100;
		$interest->created_by = request('created_by');
		$interest->save();
		return redirect()->back()->with('success', 'Transaction successful');
	}
}

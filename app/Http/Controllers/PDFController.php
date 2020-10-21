<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use \PDF;

class PDFController extends Controller {
	public function CreateLoanPaymentReceipt(Request $request) {
		$loan = DB::table('loan_repayments')
			->join('loan_applications', 'loan_repayments.id_loan', 'loan_applications.id')
			->select('loan_applications.loan_number', 'loan_repayments.*')
			->where('loan_repayments.id', '=', $request->id)
			->latest()
			->first();
		$data = ['title' => $loan];
		//dd($data);
		$pdf = PDF::loadView('apply.docs.receipts.loan_collections', compact('data'));

		return $pdf->download('PaymentReceipt.pdf');
	}
	public function CreateLoanApplicationReceipt(Request $request) {

		$loan = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', 'register_clients.id')
			->select('register_clients.name', 'loan_applications.*')
			->where('loan_applications.id', '=', $request->id)
			->first();
		$data = ['title' => $loan];
		//dd($data);

		$pdf = PDF::loadView('apply.docs.receipts.loan_application', compact('data'));

		return $pdf->download('ApplicationReceipt.pdf');
	}
}

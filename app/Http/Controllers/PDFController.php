<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use \PDF;
use NumberToWords\NumberToWords;
use NumberToWords\Locale\English;

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

		$numberToWords = new NumberToWords(new English()); // english

		$loan = DB::table('loan_applications')
			->join('register_clients', 'loan_applications.id_client', 'register_clients.id')
			->select('register_clients.name', 'loan_applications.*')
			->where('loan_applications.id', '=', $request->id)
			->first();

		$amount = DB::table('loan_applications')->select('application_fee')->where('id','=',$request->id)->first();

		$amountInWords = $numberToWords->convert($amount->application_fee);

		$data = ['title' => $loan];

		$pdf = PDF::loadView('apply.docs.receipts.loan_application', compact('data','amountInWords'));

		return $pdf->download('ApplicationReceipt.pdf');
	}
}

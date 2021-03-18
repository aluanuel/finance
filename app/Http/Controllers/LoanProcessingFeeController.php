<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\LoanProcessingFee;

class LoanProcessingFeeController extends Controller
{
    public function index(){
    	return view('apply.settings.loan_processing.index');
    }

    public function create(){
    	return redirect()->back()->with('success','Success');
    }
}

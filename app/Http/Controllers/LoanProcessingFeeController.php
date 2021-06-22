<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\LoanProcessingFee;
use Auth;

class LoanProcessingFeeController extends Controller
{
    public function index(){
        $rates =  LoanProcessingFee::orderBy('created_at','desc')
                ->get();
    	return view('apply.settings.loan_processing.index',compact('rates'));
    }

    public function create(){

        $fees = new LoanProcessingFee();
        $fees -> loan_type =  request('loan_type');
        $fees -> processing_rate = request('processing_rate');
        $fees -> created_by = Auth::user()->id;
        $fees -> save();
    	return redirect()->back()->with('success','Success');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\AppraisalFee;

class AppraisalFeeController extends Controller
{
    public function index(){

    	$fees = AppraisalFee::orderBy('created_at','desc')
    	->get();

    	return view('apply.settings.appraisal.index',compact('fees'));
    }
    public function create(){

    	$fees = new AppraisalFee();

    	$fees->appraisal_type = request('appraisal_type');
    	$fees->appraisal_amount = str_replace(',','',request('appraisal_amount'));
    	$fees->created_by = request('created_by');
    	$fees->save();
    	
    	return redirect()->back()->with('success','Success');
    }
}

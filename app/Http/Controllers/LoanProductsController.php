<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LoanProducts;

class LoanProductsController extends Controller
{
    public function index(){

        $pdt = LoanProducts::all();

        return view('apply.settings.loans.index',compact('pdt'));

    }
    
    public function create_loan_product(Request $request){

        $pdt = new LoanProducts();

        $pdt->loan_category = $request->loan_category;

        $pdt->product_name = ucfirst($request->product_name);

        $pdt->product_description = ucfirst($request->product_description);

        $pdt->interest_rate = $request->interest_rate;

        $pdt->processing_rate = $request->processing_rate;

        $pdt->rate_defaulting = $request->rate_defaulting;

        if($pdt->save()){

            return redirect()->back()->with('success','Success');

        }else{

            return redirect()->back()->with('error','Error');

        }

    }

    public function update_loan_product(Request $request){

        $pdt = LoanProducts::where('id',$request->id)->first();

        $pdt->loan_category = $request->loan_category;

        $pdt->product_name = ucfirst($request->product_name);

        $pdt->product_description = ucfirst($request->product_description);

        $pdt->interest_rate = $request->interest_rate;

        $pdt->processing_rate = $request->processing_rate;

        $pdt->rate_defaulting = $request->rate_defaulting;

        if($pdt->save()){

            return redirect()->back()->with('success','Success');

        }else{

            return redirect()->back()->with('error','Error');

        }

    }

}

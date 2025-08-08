<?php

namespace App\Http\Controllers;
use App\Models\Rates;

use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index(){

        $rates = Rates::all();

        return view('apply.settings.rates.index',compact('rates'));
    }

    public function create_new_rate(Request $request){

        $rates = new Rates();

        $rates->rate_type = $request->rate_type;

        $rates->rate = $request->rate;

        $result = $rates->save();

        if($result){

            return redirect()->back()->with('sucess','Success');
        }

        return redirect()->back()->with('error','Error');
    }
}

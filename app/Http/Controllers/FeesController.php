<?php

namespace App\Http\Controllers;
use App\Models\Fees;

use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index(){

        $fees = Fees::all();

        return view('apply.settings.accounts.index',compact('fees'));
    }

    public function create_new_fees(Request $request){

        $fees = new Fees();

        $fees->fees_type = $request->fees_type;

        $fees->amount = $request->amount;

        $result = $fees->save();

        if($result){

            return redirect()->back()->with('success','Success');
        }

        return redirect()->back()->with('error','Error');
    }
}

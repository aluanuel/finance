<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetricsController extends Controller
{
    public function single_loan_group(Request $request){

        return view('apply.metrics.group.single_loan_group');
    }
}

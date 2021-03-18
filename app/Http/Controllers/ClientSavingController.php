<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\RegisterClient;
use \App\Models\ClientSaving;
use DB;
use Auth;

class ClientSavingController extends Controller
{
    public function savingsForm(){

    	$account = RegisterClient::all();

    	$deposits = DB::table('register_clients')
    				->join('client_savings','register_clients.id','client_savings.id_client')
    				->select('register_clients.account','client_savings.*')
    				->where('client_savings.transaction_type','Deposit')
    				->orderBy('client_savings.created_at','desc')
    				->limit(50)
    				->get();

    	return view('apply.teller.savings.index', compact('account','deposits'));
    }

    public function Deposit(){
    	
    	$save = ClientSaving::where('id_client','=', request('id_client'))->first();

    	if(is_null($save)){

    		$savings_balance = request('amount_figures');

    	}else{
    		$savings_balance = $save->savings_balance + request('amount_figures');
    	}

    	$deposit = new ClientSaving();

    	$deposit->id_client = request('id_client');
    	$deposit->savings_balance = $savings_balance;
    	$deposit->amount_figures = request('amount_figures');
    	$deposit->amount_words = request('amount_words');
    	$deposit->person_name = request('person_name');
    	$deposit->person_telephone = request('person_telephone');
    	$deposit->transaction_type = 'Deposit';
    	$deposit->id_user = Auth::user()->id;
    	$deposit->save();
    	return redirect()->back()->with('success','Success');

    }
    public function Withdrawal(){
    	$save = ClientSaving::where('id_client','=', request('id_client'))
    			->latest()
    			->first();

    	if(is_null($save)){

    		return redirect()->back()->with('warning','Insufficient funds');

    	}else{

    		$balance = $save->savings_balance;

    		if(($balance - request('amount_figures')) >= 10000 ){

    			$savings_balance = $balance - request('amount_figures');

    			$withdraw = new ClientSaving();

		    	$withdraw->id_client = request('id_client');
		    	$withdraw->savings_balance = $savings_balance;
		    	$withdraw->amount_figures = request('amount_figures');
		    	$withdraw->amount_words = request('amount_words');
		    	$withdraw->person_name = request('person_name');
		    	$withdraw->person_telephone = request('person_telephone');
		    	$withdraw->transaction_type = 'Withdrawal';
		    	$withdraw->id_user = Auth::user()->id;
		    	$withdraw->save();
		    	return redirect()->back()->with('success','Success');
    		}
    		return redirect()->back()->with('warning','Insufficient funds. You can withdraw a maximum amount of '.number_format(($balance - 10000)));
    	}
    }

    public function withdrawalForm(){
    	$account = RegisterClient::all();

    	$withdraws = DB::table('register_clients')
    				->join('client_savings','register_clients.id','client_savings.id_client')
    				->select('register_clients.account','client_savings.*')
    				->where('client_savings.transaction_type','Withdrawal')
    				->orderBy('client_savings.created_at','desc')
    				->limit(50)
    				->get();
    	return view('apply.teller.savings.withdraw', compact('account','withdraws'));
    }
}

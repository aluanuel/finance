<?php

namespace App\Http\Controllers;
use \App\Models\Clients;
use \App\Models\Transactions;
use DB;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    

    public function index(){

        $rates = DB::table('loan_products')->get();

        $fees = DB::table('fees')->first();

        $groups = DB::table('loan_groups')->get();

        if(is_null($rates)){

            return redirect('/home')->with('error',"Interest on borrowing not found, please set");

        }elseif(is_null($fees)){

            return redirect('/home')->with('error',"Registration fees not found, please set");

        }

        $accounts = DB::table('clients')
                ->leftJoin('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('clients.*','loan_groups.group_name','loan_groups.group_code')
                ->orderBy('clients.id','desc')
                ->limit(100)
                ->get();

        return view('apply.accounts.view.clients',compact('accounts','rates','groups','fees'));
    }

    public function create_client_account(Request $request){


        $check = Clients::where('telephone',$request->telephone)->orWhere('id_number',$request->id_number)->first();

        if($check){

            return redirect()->back()->with('error','Telephone number or ID Number belongs to account '.$check->account_number.' - '.$check->name);

        }else{


            $new_client = new Clients();

            $new_client->name = strtoupper($request->name);

            $new_client->gender = $request->gender;

            $new_client->dob = $request->dob;

            $new_client->resident_district = ucwords($request->resident_district);

            $new_client->resident_division = ucwords($request->resident_division);

            $new_client->resident_parish = ucwords($request->resident_parish);

            $new_client->resident_village = ucwords($request->resident_village);

            $new_client->telephone = $request->telephone;

            $new_client->marital_status = $request->marital_status;

            $new_client->occupation = ucwords($request->occupation);

            $new_client->employment_type = $request->employment_type;

            $new_client->district_of_work = ucwords($request->district_of_work);

            $new_client->nationality = $request->nationality;

            $new_client->id_type = $request->id_type;

            $new_client->id_number = $request->id_number;

            $new_client->permanent_address = ucwords($request->permanent_address);

            $new_client->country = $request->country;

            $new_client->photo_id = $request->photo_id;

            $new_client->photo_client = $request->photo_client;

            $new_client->id_loan_group = $request->id_loan_group;

            $new_client->registration_fee = str_replace(',','' ,$request->registration_fee);

            $new_client->account_number = $this->generate_account_number();

            if($new_client->save()){

                $record = new Transactions();

                $record->transaction_date = date('Y-m-d');

                $record->transaction_detail = "Registration Fee - ".$request->name;

                $record->transaction_type = "Income";

                $record->id_client = $request->id;

                $record->amount = str_replace(',','',$request->registration_fee);

                $record->created_by = Auth::user()->id;

                $record->save();

            }
        }

            return redirect()->back()->with('success','Success');
    }

    public function view_client_details(Request $request){

        $client = DB::table('clients')
                ->leftJoin('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('clients.*','loan_groups.group_name','loan_groups.group_code')
                ->where('clients.id',$request->id)
                ->first();
                
        $last_loan = DB::table('loans')
                    ->where('id_client',$request->id)->latest()->first();

        if(is_null($last_loan)){

            $last_loan_recovery = [];

            $schedule = [];

        }else{

            $last_loan_recovery = DB::table('transactions')
                            ->where('id_loan',$last_loan->id)
                            ->where('transaction_detail','like','Loan Repayment%')->get();
            $schedule = DB::table('loan_schedules')->where('id_loan',$last_loan->id)->get();
        }

        $loans = DB::table('loans')->where('id_client',$request->id)->get();

        $groups = DB::table('loan_groups')->get();

        return view('apply.accounts.view.client_profile',compact('client','last_loan','last_loan_recovery','loans','groups','schedule'));
    }

    public function update_client_account_details(Request $request){

        $info = Clients::where('id',$request->id)->first();

        $info->dob = $request->dob;

        $info->telephone = $request->telephone;

        $info->alt_telephone = $request->alt_telephone;

        $info->id_number = $request->id_number;

        $info->permanent_address = $request->permanent_address;

        if($info->save()){

            return redirect()->back()->with('success','Success');
        }

        return redirect()->back()->with('error','Update failed');

    }


    public function search_client_account(Request $request){

        $accounts = DB::table('clients')
                ->leftJoin('loan_groups','clients.id_loan_group','loan_groups.id')
                ->select('clients.*','loan_groups.group_name','loan_groups.group_code')
                ->where('clients.name','like','%'.$request->name.'%')
                ->orWhere('loan_groups.group_name','like','%'.$request->name.'%')
                ->orderBy('clients.id','desc')
                ->get();

        $rates = DB::table('loan_products')->get();

        $fees = DB::table('fees')->first();

        $groups = DB::table('loan_groups')->get();

        if($accounts){

            return view('apply.accounts.view.clients',compact('accounts','rates','groups','fees'));

        }

        return redirect()->back()->with('error','Error');


    }

    public function generate_account_number(){

        $account = Clients::latest()->first();

        if(is_null($account)){

            return 500001;

        }

            $new_account = $account->account_number;

            return $new_account +=1;

    }


}

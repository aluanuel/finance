<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BranchOffice;

class BranchOfficeController extends Controller
{
    
    public function index(){

        $office = BranchOffice::all();

        return view('apply.settings.branches.index',compact('office'));
    }

    public function create_branch_office(Request $request){

        $branch = new BranchOffice();

        $branch->branch_name = strtoupper($request->branch_name);

        $branch->location = ucwords($request->location);

        $branch->telephone = $request->telephone;

        $branch->email = $request->email;

        if($branch->save()){

            return redirect()->back()->with('success','Success');

        }

        return redirect()->back()->with('error','Error');
        
    }

    public function update_branch_office(Request $request){

        $office = BranchOffice::where('id',$request->id)->first();

        if($office){

            $office->branch_name = strtoupper($request->branch_name);

            $office->location = ucwords($request->location);

            $office->telephone = $request->telephone;

            $office->email = $request->email;

            $office->branch_status = $request->branch_status;

            $office->save();

            return redirect()->back()->with('success','Success');
        }

        return redirect()->back()->with('error','Error');
    }

}

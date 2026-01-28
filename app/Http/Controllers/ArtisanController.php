<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class ArtisanController extends Controller
{
    public function backup(){

        return view('apply.system.backup');

    }

    public function run_backup(){

        $exitCode = Artisan::call('backup:run');

        if($exitCode){

            return redirect()->back()->with('error','Backup failed!');
        }else{

             return redirect()->back()->with('success','Success');
        }

    }

    public function restore(){

        return view('apply.system.restore');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SystemUserController extends Controller
{
    public function index(){
        $user = User::where('usertype','!=','administrator')
        ->get();
        return view('.apply.settings.users.index',compact('user'));
    }

    public function create()
    {
    	$password = $this->randomPassword();
    	// dd(Hash::make($password),$password);
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'usertype' => request('usertype'),
            'role' => request('role'),
            'password' => Hash::make($password),
        ]);
        return redirect()->back()->with('success','Your temporary password is '.$password);
    }

    public function profile(Request $request){
        $id = User::find($request->id);
        if($id){
            $user = User::where('id','=',$request->id)
            ->first();
        }
        return view('apply.view.user_profile',compact('user'));

    }

    public function updateProfile(Request $request){

        $user = User::find($request->id);

        if(Hash::check(request('password_old'),$user->password)){

            $password = request('password');

            $password_confirmation = request('password_confirmation');

            if($password === $password_confirmation){

                $user->password = Hash::make(request('password'));

                $user->save();

                return redirect()->back()->with('success','Password changed successfully');
            }

         }

            return redirect()->back()->with('danger','Password change failed'); 
    }

    protected function randomPassword() { 

	    $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 6; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

}

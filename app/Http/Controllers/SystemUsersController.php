<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class SystemUsersController extends Controller
{
    
    public function system_users(){

        if(Auth::user()->usertype == 'admin'){

             $user = User::all();

        }else{

            $user = User::where('usertype','!=','admin')->get();
        }

        return view('apply.settings.users.index',compact('user'));
    }

    public function create_system_user(Request $request){

        $user = new User();

        $user->name = ucfirst($request->name);
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->usertype = $request->usertype;
        $user->role = $request->role;
        $user->category = $request->category;
        $user->password = Hash::make($request->password);
        $result = $user->save();

        if($result){

            return redirect()->back()->with('sucess','Success');

        }

        return redirect()->back()->with('error','Some error occurred');

    }

    public function view_user_profile(Request $request){

        $user = User::where('id',$request->id)->first();

        return view('apply.view.user_profile',compact('user'));
    }

    public function update_user_password(Request $request){

        $password = $request->password;

        $password_confirmation  = $request->password_confirmation;

        if($password == $password_confirmation){

            $user = User::where('id',$request->id)->first();

            $user->password = Hash::make($password);

            $user->save();

            return redirect()->back()->with('success','Password updated');

        }
        return redirect()->back()->with('error','Password mismatch');
    }

    public function update_user_photo(Request $request){
        return $request->photo;
    }

    public function TemporaryPassword(Request $request){

        $password = $this->random_password(6);

        $user = User::where('id',$request->id)->first();

        $user->password = Hash::make($password);

        $user->save();

        return redirect()->back()->with('success','Your temporary password:'.$password);
    }

    private function random_password($n){

        return bin2hex(random_bytes($n/2));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SystemUserController extends Controller
{
    public function index(){
        $user = User::where('usertype','!=','admin')
        ->orderBy('created_at','desc')
        ->get();
        return view('.apply.settings.users.index',compact('user'));
    }

    public function create()
    {
    	$password = $this->randomPassword();
        
        User::create([
            'name' => request('name'),
            'telephone' => request('telephone'),
            'email' => request('email'),
            'usertype' => request('usertype'),
            'role' => request('role'),
            'user_status' => 1,
            'password' => Hash::make($password),
            'photo' => '1611593817.png',
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

    public function updatePassword(Request $request){

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

    public function updateUserPhoto(Request $request){

        $user = User::find($request->id);

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->photo->extension();

         $request->photo->move(public_path('img'), $imageName);

         $user->photo = $imageName;

         $user->save();

        return redirect()->back()->with('success','Success'); 
    }

    public function manageUser(Request $request){

        $user = User::findOrFail($request->id);

        $status = $request->state;

        switch ($status) {

            case '0':
               $user->user_status = 1;

                break;
            
            case '1':
               $user->user_status = 0;

                break;
        }

        $user->save(); 
        
        return redirect()->back()->with('success','Account updated successfully');

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

    protected function validateUser(array $data){

        return Validator::make($data,['name' => ['required', 'string', 'max:255'],
            'telephone' => ['required','string','max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'usertype' => ['required','string'],
            'role' => ['required','string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

}

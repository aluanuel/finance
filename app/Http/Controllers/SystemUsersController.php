<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\BranchOffice;
use DB;
use Auth;

class SystemUsersController extends Controller
{
    public function system_users(){

        $branches = BranchOffice::all();

        $roles = DB::table('roles')->where('name','!=','Developer')->get();

        if(Auth::user()->usertype == 'Developer'){

             $user = DB::table('users')->join('roles','users.id_role','roles.id')
                      ->select('users.*','roles.name as role')
                      ->get();

        }else{

          $user = DB::table('users')->join('roles','users.id_role','roles.id')
                    ->Where('users.usertype','!=','Developer')
                    ->select('users.*','roles.name as role')
                    ->get();
        }

        return view('apply.settings.users.index',compact('user','branches','roles'));
    }

    protected function create_system_user(Request $request){

      $validated = $request->validateke( [
          'name' => ['required', 'string', 'max:255'],
          'telephone' => ['required','string','max:12'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'usertype' => ['required','string'],
          'id_role' => ['required','unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

        // $user = new User();
        //
        // $user->name = strtoupper($request->name);
        // $user->email = $request->email;
        // $user->telephone = $request->telephone;
        // $user->usertype = $request->usertype;
        // $user->id_role = $request->id_role;
        // $user->category = $request->category;
        // $user->password = Hash::make($request->password);
        // $result = $user->save();

        if(User::create($validated)){

            return redirect()->back()->with('sucess','Success');

        }

        return redirect()->back()->with('error','Some error occurred');

    }

    public function view_user_profile(Request $request){

        $user = User::where('id',$request->id)->first();

        return view('apply.view.user_profile',compact('user'));
    }

    public function update_user_information(Request $request){

        $user = User::where('id',$request->id)->first();

        $user->name = strtoupper($request->name);
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->usertype = $request->usertype;
        $user->id_role = $request->id_role;
        $user->category = $request->category;
        $user->user_status = $request->user_status;

        if($user->save()){

            return redirect()->back()->with('sucess','Success');

        }

        return redirect()->back()->with('error','Some error occurred');

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

    public function temporary_password(Request $request){

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

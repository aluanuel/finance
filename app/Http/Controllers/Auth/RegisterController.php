<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required','string','max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'usertype' => ['required','string'],
            'role' => ['required','string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'name' => $data['name'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'usertype' => $data['usertype'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'photo' => '1611593817.png'
        ]);
    }

    public function system_users(){
        $user = User::where('usertype','!=','admin')
        ->orderBy('created_at','desc')
        ->get();
        return view('.apply.settings.users.index',compact('user'));
    }

    public function create_system_user()
    {
        $password = $this->randomPassword();
        
        User::create([
            'name' => request('name'),
            'telephone' => request('telephone'),
            'email' => request('email'),
            'usertype' => request('usertype'),
            'role' => request('role'),
            'category' => request('category'),
            'user_status' => 1,
            'password' => Hash::make($password),
            'photo' => '1611593817.png',
        ]);
        return redirect()->back()->with('success','Your temporary password is '.$password);
    }

    public function user_profile(Request $request){
        $id = User::find($request->id);
        if($id){
            $user = User::where('id','=',$request->id)
            ->first();
        }
        return view('apply.view.user_profile',compact('user'));

    }

    public function update_user_password(Request $request){

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

    public function update_user_photo(Request $request){

        $user = User::find($request->id);

        if($request->hasFile('photo')){

            $request->validate([
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
            $destination = 'photos';
             $imageName = time().'.'.$request->photo->extension();
             $path = $request->file('photo')->storeAs($destination,$imageName);
             $user->photo = $imageName;
             $user->save();
              return redirect()->back()->with('success','Success'); 

        }
    }

    public function manage_user(Request $request){

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

    public function TemporaryPassword(Request $request){
        
        $user = User::find($request->id);
        
        $temporary_password = $this->randomPassword();

        $user->password = Hash::make($temporary_password);

        $user->save();

        return redirect()->back()->with('success','Your new password is '.$temporary_password);

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

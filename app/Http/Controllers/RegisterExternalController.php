<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterExternalController extends Controller
{
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        return 'build';
    }
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function sign_up(Request $data)
    {
        $customMessages = [
            'password.min'=>'The Password must be minimum 8 digits.',
            'email.required' => 'The email is required.',
            'email.unique' => 'The email is already registered.',
        ];
        $validator = Validator::make($data->all(),[
            'name' => 'string|required',
            'email' => 'email|unique:users,email|nullable',
            'password' => 'required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ],$customMessages);

        //If validation fails
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],400);
        }

        if($this->register($data))
        return response()->json(['success'=>'Registered'],200);
        return response()->json(['error'=>'Something Went Wrong'],401);
    }
    public function welcome()
    {
        return view('welcome');
    }
}

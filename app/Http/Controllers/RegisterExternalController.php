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
        $validator= Validator::make($data->all(), [
            'name' => 'required|max:255',
            'password' => 'required|min:8',
        ]);
        if($validator->fails())
        {
            if(strlen($data->input('password'))<8)
            return "passfail";
            return "fail";
        }
        if($this->register($data))
        return "success";

        return "failure";
        //return $data;
        //return $data['password'];
        $user=new User;
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=Hash::make($data['password']);
        $user->save();
        $data->session()->put('user', $data->input('name'));
        Auth::login($user);
        return "success";
    }
}

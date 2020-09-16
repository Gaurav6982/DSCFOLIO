<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Str;
use App\UserInfo;
class AuthController extends Controller
{
    use AuthenticatesUsers;
    public function register(Request $request)
    {
        $data = [];
        //Validate credentials
        //Defining Custom messages on errors
        $customMessages = [
            'password.min'=>'The Password must be minimum 8 digits.',
            'email.required' => 'The email is required.',
            'email.unique' => 'The email is already registered.',
        ];
        $validator = Validator::make($request->all(),[
            'name' => 'string|required',
            'email' => 'email|unique:users,email|nullable',
            'password' => 'required|min:8'
        ],$customMessages);

        //If validation fails
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],400);
        }

        //If no errors Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $data['token'] = $user->createToken('UserAuthToken')->plainTextToken;
        return response()->json($data,200);
    }

    public function login(Request $request)
    {
        $data = [];
        //Validate input
        $customMessages = [
            'email.required' => 'The email is required.',
            'password.min' => 'The password must be atleast 8 digits.',
        ];
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8'
        ],$customMessages);

        //If validation fails
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],400);
        }

        //Attempt login

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            //If authenticated
            $user = Auth::user();
            $data['user'] = $user;
            $data['token'] = $user->createToken('UserAuthToken')->plainTextToken;
            return response()->json($data,200);
        }
        else
        {
            return response()->json(['error'=>'Invalid credentials'],401);
        }

    }

    public function logout_custom()
    {
        if(Auth::user())
        {
            Auth::user()->tokens()->delete();
        }
        return response()->json(['message'=>'Logged out'],201);
    }
    public function sign_in(Request $request)
    {
        //return "failure";
        $customMessages = [
            'email.required' => 'The email is required.',
            'password.min' => 'The password must be atleast 8 digits.',
        ];
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8'
        ],$customMessages);

        //If validation fails
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],400);
        }
        
        if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return response()->json(['error'=>'Invalid credentials'],401);
        }
        if($this->login($request))
        {
            $info=UserInfo::where('user_id',Auth::user()->id)->first();
            
            if(isset($info))
            {
                $data=array(
                    'success'=>'final',
                    'message'=>'Move to Final Page'
                );
            }
            else
            {
                $data=array(
                    'success'=>'build',
                    'message'=>'Move to Build Page'
                );
            }
            return response()->json($data,200);
        }

        return response()->json(['message'=>'Something Went Wrong'],400);
    }
    public function log_out(Request $request){
        
       if($this->logout($request))
       return response()->json(['message'=>'Logged out'],201);
    }
}

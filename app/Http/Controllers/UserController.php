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
use App\UserInfo;
use App\LinkSet;
use App\SocialLinks;
class UserController extends Controller
{
    use AuthenticatesUsers;
    public function sign_in(Request $request)
    {
        if($this->login($request))
        return "success";
        return "failure";
        $user=User::where('email','=',$request['email'])->first();
        if(!$user)
        return "failure";
        //return $user->password;
        if(password_verify($request['password'], $user->password)==1)
        {
            Auth::login($user);
            return "success";
        }
        return "failure";
    }
    public function log_out(Request $request){
       if($this->logout($request))
        return "success";
    }
    public function submit(Request $request)
    {
        //return $request->all();
        //$ans='';
        $user_id=Auth::user()->id;
        $input=$request->all();
        $profile=new UserInfo;
        $profile->user_id=$user_id;
        $profile->display_name=$request->input('displayname');
        $profile->description=$request->input('description');
        $profile->link_set1_name=$request->input('setname1');
        $profile->link_set2_name=$request->input('setname2');


        $i=0;
        $link='link1-'.$i;
        $heading='linkHeading1-'.$i;
        //*****************For Link Set 1****************
        while(isset($input[$link])&&isset($input[$heading]))
        {
            $links=new LinkSet;
            $links->user_id=$user_id;
            $links->link_set_num=1;
            $links->link_heading=$input[$heading];
            $links->link_url=$input[$link];
            $links->save();
            $i++;
            $link='link1-'.$i;
            $heading='linkHeading1-'.$i;
        }
         $i=0;
        $link='link2-'.$i;
        $heading='linkHeading2-'.$i;

        //*****************For Link Set 2****************
        while(isset($input[$link])&&isset($input[$heading]))
        {
            $links=new LinkSet;
            $links->user_id=$user_id;
            $links->link_set_num=2;
            $links->link_heading=$input[$heading];
            $links->link_url=$input[$link];
            $links->save();
            $i++;
            $link='link2-'.$i;
            $heading='linkHeading2-'.$i;
        }
        $i=0;
        $link='link-'.$i;
        $heading='Selected-'.$i;
        //*****************For Social Links****************
        while(isset($input[$link])&&isset($input[$heading]))
        {
            $links=new SocialLinks;
            $links->user_id=$user_id;
            $links->link_name=$input[$heading];
            $links->link_url=$input[$link];
            $links->save();
            $i++;
            $link='link-'.$i;
            $heading='Selected-'.$i;
        }
        if($profile->save())
        return "success";
        return "fail";
    }
}

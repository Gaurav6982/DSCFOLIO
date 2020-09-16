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
use Str;
class UserController extends Controller
{
    
    public function submit(Request $request)
    {
        $input=$request->all();
        //return response()->json($request->all());
        $info=UserInfo::where('user_id',Auth::user()->id)->first();
            if(isset($info))
            {
                $data=[
                    'status'=>'back',
                    'message'=>'Move to Previous Page.'
                ];
                return response()->json($data,200);
            }
            // return "back";
        //return $request->all();
        //$ans='';
        $rules=[
            'displayname'=>'required',
            'description'=>'required', 
            'Resumelink'=>'required',
            'setname1'=>'required',
            'setname2'=>'required',
        ];
        $i=0;
        $link='link1-'.$i;
        $heading='linkHeading1-'.$i;
        
        //========Check for Empty Links=========
        while($request->has($link))
        {
            $rules[$link] = 'required';
            $link='link1-'.++$i;
        }
        //========Check for Empty Links=========
        $i=0;
        //========Check for Empty Heads=========
        while($request->has($heading))
        {
            $rules[$heading] = 'required';
            $heading='linkHeading1-'.++$i;
        }
        //========Check for Empty Heads=========
        $i=0;
        $link='link2-'.$i;
        $heading='linkHeading2-'.$i;
        
        //========Check for Empty Links=========
        while($request->has($link))
        {
            $rules[$link] = 'required';
            $link='link2-'.++$i;
        }
        //========Check for Empty Links=========
        $i=0;
        //========Check for Empty Heads=========
        while($request->has($heading))
        {
            $rules[$heading] = 'required';
            $heading='linkHeading2-'.++$i;
        }
        //========Check for Empty Heads=========

        $i=0;
        $link='link-'.$i;
        $heading='Selected-'.$i;
        //========Check for Empty Links=========
        while($request->has($link))
        {
            $rules[$link] = 'required';
            $link='link-'.++$i;
        }
        //========Check for Empty Links=========
        $i=0;
        //========Check for Empty Heads=========
        while($request->has($heading))
        {
            $rules[$heading] = 'required';
            $heading='Selected-'.++$i;
        }
        //========Check for Empty Heads=========
        // return response()->json($rules);
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(['error'=>'All Fields are Required.'],400);
        }
        $user=Auth::user();
        $user_id=$user->id;
        
        $profile=new UserInfo;
        $profile->user_id=$user_id;
        $profile->display_name=$request->input('displayname');
        $profile->description=$request->input('description');
        $resume_link=$request->input('Resumelink');
        if(strpos($resume_link, "http://")!==false || strpos($resume_link, "https://")!==false)
        $profile->resume=$request->input('Resumelink');
        else
        $profile->resume='https://'.$request->input('Resumelink');
        $profile->profile_picture=$request->input('Imagevalue');
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

            if(strpos($input[$link], "http://")!==false || strpos($input[$link], "https://")!==false)
            $links->link_url=$input[$link];
            else
            $links->link_url='https://'.$input[$link];
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
            if(strpos($input[$link], "http://")!==false||strpos($input[$link], "https://")!==false)
            $links->link_url=$input[$link];
            else
            $links->link_url='https://'.$input[$link];

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
            if(strpos($input[$link], "http://")!==false||strpos($input[$link], "https://")!==false)
            $links->link_url=$input[$link];
            else
            $links->link_url='https://'.$input[$link];
            $links->save();
            $i++;
            $link='link-'.$i;
            $heading='Selected-'.$i;
        }
        if($profile->save())
        {
            $name=Str::slug($user->name);
            $slug=$name.$user->id.'-'.time();
            $user->slug=$slug;
            $user->save();
            return response()->json(['status'=>'success'],200);
        }
        return response()->json(['status','error'],400);
    }
    public function check_url($url)
    {
        $regex = "((https?|ftp)\:\/\/)?"; // SCHEME
    //$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
    //$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
    //$regex .= "(\:[0-9]{2,5})?"; // Port
    //$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
    //$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
    //$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

       if(preg_match("/^$regex$/i", $url)) // `i` flag for case-insensitive
       {
               return true;
       }
       return false;
    }
    public function user_details(){
        $user=Auth::user();

        $user_info=$user->info;
        $set1_links=$user->link_set_1;
        $set2_links=$user->link_set_2;
        $social_links=$user->social;
        $user_det=array(
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'display_name'=>$user_info->display_name,
            'description'=>$user_info->description,
            'profile_picture'=>$user_info->profile_picture,
            'resume'=>$user_info->resume,
            'link_set1_name'=>$user_info->link_set1_name,
            'link_set2_name'=>$user_info->link_set2_name,
            'set1_links'=>$set1_links,
            'set2_links'=>$set2_links,
            'social_links'=>$social_links,
        );
        $data=array(
            'user'=>$user_det,
            'info'=>$user_info,
            'set1_links'=>$set1_links,
            'set2_links'=>$set2_links,
            'social_links'=>$social_links,
        );
        //return $user_det;
        return response()->json($user_det);
    }
    public function final(){

        $info=UserInfo::where('user_id',Auth::user()->id)->first();
        if(!isset($info))
        return redirect('/build');
        return view('finaldash');
    }
    public function getusername(){
        return response()->json(['username'=>Auth::user()->name]);
    }
    public function getslug(){
        // return response()->json(['key'=>Auth::user()->slug],200);
        if(Auth::check())
        return response()->json(['key'=>Auth::user()->slug],200);
        return response()->json(['error','Not Found'],400);
    }
    public function getimage(){

        if(!Auth::check())
        return response()->json(['error','Not Found']);
        $info=UserInfo::where('user_id',Auth::user()->id)->first();
        return response()->json(['key'=>$info->profile_picture]);
    }
    public function getresume(){
        if(!Auth::check())
        return response()->json(['error','Not Found']);
         $info=UserInfo::where('user_id',Auth::user()->id)->first();
        return response()->json(['key'=>$info->resume]);
    }
    public function share_details($slug){
         $user=User::where('slug',$slug)->first();

        $user_info=$user->info;
        $set1_links=$user->link_set_1;
        $set2_links=$user->link_set_2;
        $social_links=$user->social;
        $user_det=array(
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'display_name'=>$user_info->display_name,
            'description'=>$user_info->description,
            'profile_picture'=>$user_info->profile_picture,
            'resume'=>$user_info->resume,
            'link_set1_name'=>$user_info->link_set1_name,
            'link_set2_name'=>$user_info->link_set2_name,
            'set1_links'=>$set1_links,
            'set2_links'=>$set2_links,
            'social_links'=>$social_links,
        );
        $data=array(
            'user'=>$user_det,
            'info'=>$user_info,
            'set1_links'=>$set1_links,
            'set2_links'=>$set2_links,
            'social_links'=>$social_links,
        );
        //return $user_det;
        return response()->json($user_det);
    }
    public function share($slug){
        $user=User::where('slug',$slug)->first();
        //return $user;
        if(isset($user))
        return view('share');

    }
    public function edit(){
        return view('edit');
    }
    public function edit_user(Request $request){
        // return $request->json()->all();
        $info=UserInfo::where('user_id',Auth::user()->id)->first();
        if(!isset($info))
            {
                $data=[
                    'status'=>'back',
                    'message'=>'Move to Build Page.'
                ];
                return response()->json($data,200);
            }
        //return $request->all();
        //$ans='';
        $this->validate($request,[
            'displayname'=>'required',
            'description'=>'required',
            'Resumelink'=>'required',
            'setname1'=>'required',
            'setname2'=>'required',
        ]);
        $user=Auth::user();
        $user_id=$user->id;
        $input=$request->all();
        $profile=UserInfo::where('user_id',$user_id)->first();
        // $profile->user_id=$user_id;
        $profile->display_name=$request->input('displayname');
        $profile->description=$request->input('description');
        $resume_link=$request->input('Resumelink');
        if(strpos($resume_link, "http://")!==false || strpos($resume_link, "https://")!==false)
        $profile->resume=$request->input('Resumelink');
        else
        $profile->resume='https://'.$request->input('Resumelink');
        $profile->profile_picture=$request->input('Imagevalue');
        $profile->link_set1_name=$request->input('setname1');
        $profile->link_set2_name=$request->input('setname2');
        $old_sets=LinkSet::where('user_id',$user_id)->get();
        $social_sets=SocialLinks::where('user_id',$user_id)->get();
        foreach($old_sets as $set)
        $set->delete();
        foreach($social_sets as $set)
        $set->delete();

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

            if(strpos($input[$link], "http://")!==false || strpos($input[$link], "https://")!==false)
            $links->link_url=$input[$link];
            else
            $links->link_url='https://'.$input[$link];
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
            if(strpos($input[$link], "http://")!==false||strpos($input[$link], "https://")!==false)
            $links->link_url=$input[$link];
            else
            $links->link_url='https://'.$input[$link];

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
            if(strpos($input[$link], "http://")!==false||strpos($input[$link], "https://")!==false)
            $links->link_url=$input[$link];
            else
            $links->link_url='https://'.$input[$link];
            $links->save();
            $i++;
            $link='link-'.$i;
            $heading='Selected-'.$i;
        }
        if($profile->save())
        {
            $name=Str::slug($user->name);
            $slug=$name.$user->id.'-'.time();
            $user->slug=$slug;
            $user->save();
            return response()->json(['status'=>'success'],200);
        }
        return response()->json(['status'=>'error'],400);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\EventTutorial\UserSubscribed;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Userprofile;
use Illuminate\Support\Str;


class NewsLetterController extends Controller
{
    public function index()
    {
        $pc = Userprofile::where("user_id", Auth::user()->id)
        ->latest()->first();
        $profile_picture = $pc? ($pc['profile_picture']): NULL;

        return view("EventTutorial.index",[
            'profile_pic' =>  $profile_picture
        ]);
    }

    public function subscribe(Request $request)
    {
        
     $request->validate([
        'email' => ['required','email']
     ],[
        'email.required' => "Type email to subscribe",
        'email.email' => "Email Address must be valid"
     ]);
    //  dd($request->input('email'));
     event(new UserSubscribed($request->input('email')));

     return back()
     ->with('EmailSuccess',"Thanks for subscribing us , check your email address");
    }


    public function listen()
    {
        return view("EventTutorial.listen");
    }

    public function SaveFiles()
    {
        Storage::disk('public')->put('myfile.text',"Hello test file from laravel");
        return back();
    }


    public function Bad_way_for_fileInfo(Request $request)
    {
        $request->validate([
            'profile-picture'=> ['required','image','max:2048']
        ]);

        // let laravel design file name for this file
        $file = $request->file("profile-picture"); 
        $custome_filename = 'profile.'.$file->getClientOriginalExtension();
        $path = $file->store('profile-picture','public');
        // simple store method allow to define disk type
        $file_url = Storage::url($path);
        Userprofile::create([
            'user_id' => Auth::user()->id,
            "profile_picture" => $file_url
        ]);

        return back();
    
    }


    // more best for public disk
    public function SaveProfileToAmazonLOCAL_DISK(Request $request)
    {
        $request->validate([
            'profile-picture'=> ['required','image','max:2048']
        ]);
        $user_id = Auth::user()->id;
        $pc = Userprofile::where("user_id", $user_id)
                     ->latest()
                     ->first();
        
        $pc = $pc? Str::replaceFirst("/storage/","/",$pc['profile_picture']): "";
      
        if(Storage::disk('public')->exists($pc))
        {
            Userprofile::where("user_id", $user_id)->delete();
            Storage::disk("public")->delete($pc);
        }
        $file = $request->file('profile-picture');
        $filename= $file->hashName();
        $path = $file->storeAs('profile-picture',$filename,'public');
        $fileUrl = Storage::url($path);
    
        Userprofile::create([
            'user_id' => $user_id,
            "profile_picture" => $fileUrl
        ]);
        return back();
    }


    // another way for s3 Uploading
    public function SaveProfileToAmazon(Request $request)
    {
        $request->validate([
            'profile-picture'=> ['required','image','max:2048']
        ]);
        $user_id = Auth::user()->id;
        $pc = Userprofile::where("user_id", $user_id)
                     ->latest()
                     ->first();
        
        $pc = $pc? $pc['profile_picture']: "";

        if($pc)
        {
    
            if(Storage::disk('s3')->exists($pc))
            {
                Userprofile::where("user_id", $user_id)->delete();
                Storage::delete($pc);
            }
        }
      
        
        $file = $request->file('profile-picture');
        $filename= $file->getClientOriginalName();
        $path = $file->storeAs('profilepicture',$filename,'s3');

        Userprofile::create([
            'user_id' => $user_id,
            "profile_picture" => $path 
        ]);
        return back();
    }





}

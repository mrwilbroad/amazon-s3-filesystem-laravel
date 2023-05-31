<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\APICreateRequest;

class APIServiceController extends Controller
{


    public function index()
    {
        $tokens = Auth::user()->tokens;
     
        return view("start.Dashbord");
       
    }
    
    public function UserRequestAPIKEY(APICreateRequest $request)
    {
        $info = $request->safe()->all();
        // Auth::user()->tokens()
        //               ->where('tokenable_id', Auth::user()->id)
        //              ->delete();

        // token ability
        // tasks-resource
        $TokenInfo = Auth::user()->createToken($info['projectname'],['crud-operation']);
      
        $userToken = $TokenInfo->plainTextToken;
        $apiToken = [
            'token' => $userToken,
            "projectname" => $info['projectname'],
            'alert' => "This api key will dissapear as soon as you refresh this page"
        ];
        return back()->with("apiInfo",$apiToken);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        
    }

   
}

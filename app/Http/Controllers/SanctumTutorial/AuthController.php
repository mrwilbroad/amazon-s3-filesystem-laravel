<?php

namespace App\Http\Controllers\SanctumTutorial;

use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SanctumTutorial\LoginRequest;
use App\Http\Requests\SanctumTutorial\UserStoreRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use HttpResponse;
    use AuthenticatesUsers;


    
  


    public function login(LoginRequest $request)
    {
        $credential = $request->safe()->all();
        if(!$this->attemptLogin($request))
        {
            return $this->sendFailedLoginResponse($request);
        }

     

        $user = User::where("email", $credential['email'])->first();

        return $this->success([
            'user' => $user,
            "Token"  => $user->createToken("APi Token of ".$user['name'])
                              ->plainTextToken
        ]);
    }


    public function register(UserStoreRequest $request)
    {
     
        $credential = $request->safe()->all();

        $user = User::create([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => Hash::make($credential['password']),
        ]);

        return $this->success([
            'user'=> $user,
            "Token" => $user->createToken("API Token of ".$user['name'])
                            ->plainTextToken
        ]); 
    }



    public function logout()
    {
        // it work though you see red error
       Auth::user()->currentAccessToken()->delete();

       return $this->success([
        'message' => 'You have successfull logout and token have been'
       ]);
        return response()->json("This is logout");
    }
}

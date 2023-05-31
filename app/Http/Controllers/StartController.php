<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SanctumTutorial\LoginRequest;
use App\Http\Requests\SanctumTutorial\UserStoreRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\APICreateRequest;
use Illuminate\Support\Facades\DB;

class StartController extends Controller
{
    use AuthenticatesUsers;



    protected $redirectTo = "dashbord";

    public function __construct()
    {
        $this->middleware("guest")->except('logout');
    }


    public function index()
    {
      
        return view("start.home");
    }


    public function loginview()
    {
        return view("auth.login");
    }

    public function create()
    {
        return view("auth.register");
    } 
    
    
    /**login
     * register
     *
     * @param  mixed $request
     * @return void
     */
    public function register(UserStoreRequest $request)
    {

        $credential = $request->safe()->all();

        $user = User::create([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => Hash::make($credential['password']),
        ]);

        return redirect()->route('app.login')
        ->with("isregistered","You are successfull registered to mrwilbroad-developer-option");

        
    }
    
    
    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        $credential = $request->safe()->all();
        if(!$this->attemptLogin($request))
        {
            return $this->sendFailedLoginResponse($request);
        }

        return $this->sendLoginResponse($request);

    
    }


   





}

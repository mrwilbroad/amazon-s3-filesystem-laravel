<?php

use App\Events\BroadCastingTutorial\MessageNotification;
use App\Http\Controllers\APIServiceController;
use App\Http\Controllers\NewsLetterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StartController;
use App\Http\Controllers\YoutubeTutorial\YoutubeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function(){
    return redirect()->route('app.home');
});


// request-api-key


Route::controller(StartController::class)->name("app.")->group(function(){

    Route::get("/home","index")->name("home");
    Route::get("/login", "loginview")->name("login");
    Route::post("/login", "login")->name("attemt");
    Route::get("/register","create")->name("create");
    Route::post("/register","register")->name("register");
});


Route::group(['middleware'=> ['auth']], function(){

    Route::controller(APIServiceController::class)->group(function()
    {
        Route::get("/dashbord","index")->name("dashbord");
        Route::post("/logout", "logout")->name("logout");
        Route::post("/projet-name","UserRequestAPIKEY")->name("project-api");
        Route::delete('/api-key-delete/{tokenid}',"DeleteAPIKey")->name("apikeyDelete");
    });
    Route::prefix('/EventTutorial')->group(function(){

        Route::controller(NewsLetterController::class)->group(function(){
    
            Route::get("/",'index');
            Route::post("subscribe",'subscribe');
            Route::get("listen",'listen');
            Route::get("save-files",'SaveFiles');
            Route::post("save-files",'SaveProfileToAmazon');

    
        });
        Route::get('events', function(){

            event(new MessageNotification('This is our First broadcasting message..'));
        });
        
       
    });


    Route::controller(YoutubeController::class)->group(function(){

        Route::prefix("/Youtube")->group(function(){
            Route::get("index",'index');
            Route::post("index","GetContent")->name("youtubeRequest");
        });
    });
    
});










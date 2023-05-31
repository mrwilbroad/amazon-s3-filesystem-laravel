<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanctumTutorial\AuthController;
use App\Http\Controllers\SanctumTutorial\TasksController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/**
 * public Routes(Every user)
 * protected routes(Authenticated user only)
 */


/**
 * public routes
 */
Route::controller(AuthController::class)->name("api.")->group(function(){

    // Route::get("/login", "loginview")->name("login");
    Route::post("/login", "login")->name("attemt");
    Route::get("/register","create")->name("create");
    Route::post("/register","store")->name("register");
    
});



/**
 * protected routes
 */
Route::group(['middleware' => ['auth:sanctum','abilities:crud-operation']], function(){

    Route::resource("/tasks",TasksController::class)->withTrashed();
    Route::post("/logout", [AuthController::class,"logout"]);
});






<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',[AuthController::class, 'logout']);

// dashboard
    Route::get('/dashboard',[ViewController::class,'admin']);
// option user ( gua pindahin ke atas biar ga ke tiban)
Route::get('/user/option', [UserController::class, 'option']);

// ini route user dan role admin
Route::resource('/user', UserController::class);
Route::resource('/role', RoleController::class);


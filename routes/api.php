<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Forgot_passwordController;
use App\Http\Controllers\api\ConfigController;

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

// Route for login
Route::get('/data', [App\Http\Controllers\api\DataController::class, 'index']);
Route::get('/fetch-data', [ConfigController::class, 'fetchData']);
Route::POST('/insert_data', [ConfigController::class, 'insertData']);
Route::POST('/login', [App\Http\Controllers\api\LoginController::class, 'login']);
Route::POST('/register', [App\Http\Controllers\api\RegisterController::class, 'register']);
Route::POST('/send-otp', [Forgot_passwordController::class, 'sendOtp']);


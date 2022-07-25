<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ApplicationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/addmail',[EmailController::class,'store']);
Route::get('/show-emails/{id}',[EmailController::class,'show']);
Route::get('/getEmails',[EmailController::class,'index']);
Route::post('/addApplication',[ApplicationController::class,'create']);
Route::get('/getApps',[ApplicationController::class,'index']);

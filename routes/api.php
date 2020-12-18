<?php

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
use App\Http\Controllers\AliApiController;

Route::get('/createuploadvideo', [AliApiController::class, 'createUploadVideo']);
Route::get('/refreshuploadvideo', [AliApiController::class, 'refreshUploadVideo']);
   
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

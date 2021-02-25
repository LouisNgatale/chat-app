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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



    Route::get('/allUsers', [App\Http\Controllers\ApiEndpoints::class, 'allUsers']);
    Route::get('/conversation', [App\Http\Controllers\ApiEndpoints::class, 'allConversations']);
    Route::get('/getConversation/{id}', [App\Http\Controllers\ApiEndpoints::class, 'getConversation']);
    Route::post('/newConversation/{id}', [App\Http\Controllers\ApiEndpoints::class, 'createConversation']);
    Route::post('/sendMessage', [App\Http\Controllers\ApiEndpoints::class, 'sendMessage']);
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
    Route::get('/search/{name}', [\App\Http\Controllers\ApiEndpoints::class, 'search']);


    Route::post('/makecall/{id}', [\App\Http\Controllers\VideoChatController::class, 'makeCall']);
    Route::post('/cancelCall/{id}', [\App\Http\Controllers\VideoChatController::class, 'cancel']);
    Route::post('/acceptCall/{id}', [\App\Http\Controllers\VideoChatController::class, 'accept']);

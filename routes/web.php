<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();





Route::group(['middleware'=>'auth'],function (){
    //Completed Registration
    Route::group(['middleware' => ['complete_registration']], function (){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
            ->name('home')
            ->middleware('auth:sanctum');
    });

   Route::post('/create-profile',
       [\App\Http\Controllers\ProfileController::class, 'store']
   )->name('create-profile');

   Route::get('/register/profile',function (){
        return view('auth.create_profile');
   })->name('register-profile');
});











//Api Endpoints
Route::get('/allUsers', [App\Http\Controllers\ApiEndpoints::class, 'allUsers'])->name('home');
Route::get('/conversation', [App\Http\Controllers\ApiEndpoints::class, 'allConversations'])->name('home')->middleware('auth:sanctum');
Route::get('/getConversation/{id}', [App\Http\Controllers\ApiEndpoints::class, 'getConversation'])->name('home')->middleware('auth:sanctum');
Route::post('/newConversation/{id}', [App\Http\Controllers\ApiEndpoints::class, 'createConversation'])->name('home');
Route::post('/sendMessage', [App\Http\Controllers\ApiEndpoints::class, 'sendMessage'])->name('home');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::post('/makecall/{id}', [\App\Http\Controllers\VideoChatController::class, 'makeCall']);
Route::post('/cancelCall/{id}', [\App\Http\Controllers\VideoChatController::class, 'cancel']);
Route::post('/acceptCall/{id}', [\App\Http\Controllers\VideoChatController::class, 'accept']);
Route::get('/search/{name}', [\App\Http\Controllers\ApiEndpoints::class, 'search']);

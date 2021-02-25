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


Auth::routes();

Route::group(['middleware'=>'auth'],function (){
    //Has Completed Registration
    Route::group(['middleware' => ['complete_registration']], function (){

        //Social Networking Module
        Route::group([],function (){
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
                ->name('home')
                ->middleware('auth:sanctum');
        });

        // Messaging Module
        Route::group(['prefix'=>'messaging'],function (){
            Route::get('/', [App\Http\Controllers\ChatController::class, 'index'])
                ->name('message')
                ->middleware('auth:sanctum');
            });
    });

    // Create profile for the first time
    Route::group(['middleware'=> 'create_profile'],function (){
        //Create Profile for the first time
       Route::post('/create-profile',
           [\App\Http\Controllers\ProfileController::class, 'store']
       )->name('create-profile');

       Route::get('/register/profile',function (){
            return view('auth.create_profile');
       })->name('register-profile');
    });
});


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
    Route::group(['middleware' => 'complete_registration'], function (){

        //Social Networking Module Web Routes
        Route::group([],function (){
            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
                ->name('home')
                ->middleware('auth:sanctum');


        });

        // Messaging Module Web Routes
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

//Vue API Calls
Route::group([], function (){
    Route::get('/user',[\App\Http\Controllers\UserController::class, 'index']);
    Route::post('/createPost',[\App\Http\Controllers\PostController::class, 'store']);
    Route::get('/posts',[\App\Http\Controllers\PostController::class,'index']);

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
});

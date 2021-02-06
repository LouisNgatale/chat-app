<?php

use Illuminate\Http\Request;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:sanctum');

//Api Endpoints
Route::get('/allUsers', [App\Http\Controllers\ApiEndpoints::class, 'allUsers'])->name('home');
Route::get('/conversation', [App\Http\Controllers\ApiEndpoints::class, 'allConversations'])->name('home')->middleware('auth:sanctum');
Route::get('/getConversation/{id}', [App\Http\Controllers\ApiEndpoints::class, 'getConversation'])->name('home')->middleware('auth:sanctum');
Route::post('/newConversation/{id}', [App\Http\Controllers\ApiEndpoints::class, 'createConversation'])->name('home');
Route::post('/sendMessage', [App\Http\Controllers\ApiEndpoints::class, 'sendMessage'])->name('home');


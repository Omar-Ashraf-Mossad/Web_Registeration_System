<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\FetchController;

Route::get('/', function () {
    return view('welcome');
})->name('Home');

Route::post('/register', [AuthManager::class,'registerUser'])->name('RegisterUser');
Route::get('/checkUser/{name}',[AuthManager::class,'checkUser'])->name('checkUser');

Route::get('/getActors/{month}/{day}',[FetchController::class,'fetchActors'])->name('getActors');
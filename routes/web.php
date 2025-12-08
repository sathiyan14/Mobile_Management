<?php

use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Usercontroller::class, 'hello']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

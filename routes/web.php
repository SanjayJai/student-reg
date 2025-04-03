<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterviewController;
// hello

Route::get('/', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('welcome');
});



// Route to handle form submission
Route::post('/interview-form', [InterviewController::class, 'store'])->name('interview.store');

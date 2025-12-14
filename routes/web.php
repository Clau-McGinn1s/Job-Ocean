<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Route;

Route::get('', fn() => to_route('jobs.index'));


Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

Route::get('sing_in', fn()=> to_route('auth.store'))
    ->name('sign_in');
Route::get('login', fn() => to_route('auth.create')) //alias for auth.create
    ->name('login');   

Route::resource('auth', AuthController::class)
    ->only(['create','store']);


Route::get('logout', fn() => to_route('auth.destroy'))
    ->name('logout');

Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');


Route::middleware('auth')->group(function(){
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);
});
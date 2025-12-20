<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadCv;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePicDelete;
use App\Http\Controllers\ProfilePicGet;
use App\Http\Controllers\ProfilePicUpload;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('', fn() => to_route('jobs.index'));

Route::resource('jobs', JobController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

Route::get('sing_in', fn()=> to_route('auth.store'))
    ->name('sign_in');
Route::get('login', fn() => to_route('auth.create')) //alias for auth.create
    ->name('login');   
Route::get('logout', fn() => to_route('auth.destroy'))
    ->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::resource('auth', AuthController::class)
    ->only(['create','store']);

Route::middleware('auth')->group(function(){
    Route::resource('jobs.applications', JobApplicationController::class)
        ->only(['create', 'store', 'destroy', 'index']);

    Route::get("jobs/{user}/trashed", [JobController::class, "trashed"])
        ->name("jobs.trashed");

    Route::get("jobs/{user}/applications/trashed", [JobApplicationController::class, "trashed"])
        ->name("jobs.applications.trashed");

    Route::resource("user.profile", ProfileController::class)
        ->only(['create', 'store', 'edit', 'update', 'show']);
});

Route::resource('user', UserController::class)
    ->only(['create', 'store', 'show',]);

Route::resource('employer', EmployerController::class)
    ->only(['create', 'store', 'show']);

Route::get('jobs/applications/download/{application}', DownloadCv::class)
    ->name('jobs.applications.download');

Route::post('user/profile/{profile}/picture', ProfilePicUpload::class)
    ->name('user.profile.picture.store');

Route::get('user/profile/{profile}/picture/delete', ProfilePicDelete::class)
    ->name('user.profile.picture.delete');

Route::get('profile/picture/{path}', ProfilePicGet::class)
    ->where('path', '.*')
    ->name('profile.picture');
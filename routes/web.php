<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(\App\Http\Controllers\Frontend\AuthController::class)->middleware('guest:web')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'postLogin')->name('post-login');
    Route::get('register', 'register')->name('register');
    Route::post('register', 'postRegister')->name('post-register');
});

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::middleware('auth:web')->group(function () {

    Route::get('logout', [HomeController::class, 'logout'])->name('logout');

    Route::controller(\App\Http\Controllers\Frontend\ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/{user}', 'show')->name('show');
        Route::post('add-image', 'addImage')->name('add-image');
        Route::get('delete-image/{userImage}', 'deleteImage')->name('delete-image');
        Route::post('update-profile', 'updateProfile')->name('update-profile');
    });

    Route::controller(\App\Http\Controllers\Frontend\InterestController::class)->prefix('interest')->name('interest.')->group(function () {
        Route::get('/{type}', 'index')->name('index');
    });

    Route::get('details', [\App\Http\Controllers\Frontend\AuthController::class, 'details'])->name('details');
    Route::post('details', [\App\Http\Controllers\Frontend\AuthController::class, 'updateUserDetails'])->name('details-user-update');
    Route::get('get-cities/{country}', [\App\Http\Controllers\Frontend\AuthController::class, 'getCities'])->name('get-cities');

    Route::get('success-stories', [\App\Http\Controllers\Frontend\SuccessStoryController::class, 'index'])->name('success-story.index');
    Route::post('success-stories/store', [\App\Http\Controllers\Frontend\SuccessStoryController::class, 'store'])->name('success-story.store');

    Route::post('chat/{user}', [\App\Http\Controllers\Frontend\ChatController::class, 'sendMessage'])->name('send-message');
});

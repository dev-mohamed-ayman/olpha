<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('update', [\App\Http\Controllers\Api\AuthController::class, 'update']);
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\Api\AuthController::class, 'me']);

});

Route::middleware('api', 'jwt.verify')->group(function () {
    Route::controller(\App\Http\Controllers\Api\UserDetailsController::class)->prefix('details')->group(function () {
        Route::post('store-or-update', 'add');
        Route::post('update', 'updateUserDetails');
    });

    Route::controller(\App\Http\Controllers\Api\UserImageController::class)->prefix('user-images')->group(function () {
        Route::get('/', 'images');
        Route::post('/add', 'addImages');
        Route::post('/delete', 'deleteImage');
    });

    Route::controller(\App\Http\Controllers\Api\InterestController::class)->group(function () {
        Route::post('interest', 'interest');
        Route::post('add-remove-interest', 'addAndRemoveInterest');
        Route::post('ignorance', 'ignorance');
        Route::post('add-remove-ignorance', 'addAndRemoveIgnorance');
        Route::post('interest-me', 'interestMe');
    });

    Route::post('success-stories/store', [\App\Http\Controllers\Api\SuccessStoryController::class, 'store'])->name('success-story.store');

    // Chat
    Route::post('chat', [\App\Http\Controllers\Api\ChatController::class, 'chat']);
    Route::post('chat/send', [\App\Http\Controllers\Api\ChatController::class, 'sendMessage']);

});
Route::get('success-stories', [\App\Http\Controllers\Api\SuccessStoryController::class, 'index'])->name('success-story.index');

Route::controller(\App\Http\Controllers\Api\CountryAndCityController::class)->group(function () {
    Route::get('countries', 'countries');
    Route::get('cities', 'cities');
});

Route::get('members', [\App\Http\Controllers\Api\MemberController::class, 'members']);
Route::get('member/{user}', [\App\Http\Controllers\Api\MemberController::class, 'member']);
Route::get('members/search', [\App\Http\Controllers\Api\MemberController::class, 'search']);

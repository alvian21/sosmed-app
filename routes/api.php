<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\FollowController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->name('logout');
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('user', [AuthController::class, 'user'])->name('user');

    Route::resource('post', PostController::class);

    Route::resource('comment', CommentController::class);

    Route::resource('like', LikeController::class);

    Route::resource('search', SearchController::class);

    Route::resource('profile', ProfileController::class);

    Route::resource('follow', FollowController::class);
});

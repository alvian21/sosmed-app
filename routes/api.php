<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
    Route::post('logout', 'logout')->name('logout');
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('user', [AuthController::class, 'user'])->name('user');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

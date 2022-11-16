<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RestaurantController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', [UserController::class, 'user']);
    Route::get('users/updateinfo', [UserController::class, 'updateInfo']);
    Route::get('users/updatepassword', [UserController::class, 'updatePassword']);
    Route::post('upload', [ImageController::class, 'upload']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('orders', OrderController::class)->only('index', 'show');
    Route::apiResource('restaurants', RestaurantController::class);

    Route::post('forgot-password', [PasswordResetController::class, 'forgotPassword']);
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword']);

    Route::get('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');


    Route::post('logout', [AuthController::class, 'logout']);
});
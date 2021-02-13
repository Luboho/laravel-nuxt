<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\VerificationController;

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

// Auth
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/verify', [VerificationController::class, 'verify']);
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);

// Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');


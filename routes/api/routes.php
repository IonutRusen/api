<?php

declare(strict_types=1);

use App\Http\Controllers\api\Auth\ForgotPasswordController;
use App\Http\Controllers\api\Auth\LoginController;
use App\Http\Controllers\api\Auth\LogoutController;
use App\Http\Controllers\api\Auth\RefreshTokenController;
use App\Http\Controllers\api\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', fn(Request $request) => $request->user());
Route::prefix('v1')->as('v1:')->middleware('auth:sanctum')->group(static function (): void {
    Route::prefix('companies')->as('companies:')
        ->group(base_path(
            path: 'routes/api/api/v1/companies.php',
        ));
});

Route::group(['prefix' => 'auth'], function (): void {
    Route::post('login', LoginController::class)->name('user.login');
    Route::post('forgot-password', ForgotPasswordController::class)->name('user.forgot-password');
    Route::post('reset-password', ResetPasswordController::class)->name('user.reset-password');

    Route::group(['middleware' => 'auth:sanctum'], function (): void {
        Route::post('logout', LogoutController::class)->name('user.logout');
        Route::post('refresh', RefreshTokenController::class)->name('user.refresh');
    });
});

<?php

declare(strict_types=1);


use App\Http\Controllers\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/auth'], function (): void {
    Route::post('login', [AuthController::class, 'login'])->name('user.login');

    Route::group(['middleware' => 'auth:sanctum'], function (): void {
        Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
        Route::get('user', [AuthController::class, 'user'])->name('user.verify');
    });
});



Route::middleware(['auth:sanctum'])->get('v1/user', fn(Request $request) => $request->user());
Route::prefix('v1')->as('v1:')->middleware('auth:sanctum')->group(static function (): void {
    Route::prefix('companies')->as('companies:')
        ->group(base_path(
            path: 'routes/api/api/v1/companies.php',
        ));
});

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('test', App\Http\Controllers\TestController::class);

Route::get('{any?}', fn() => view('application'))->where('any', '.*')->where('any', '^(?!api).*$');

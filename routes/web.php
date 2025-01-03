<?php

use Illuminate\Support\Facades\Route;


Route::get('test',\App\Http\Controllers\TestController::class);

Route::get('{any?}', function() {
    return view('application');
})->where('any', '.*')->where('any', '^(?!api).*$');
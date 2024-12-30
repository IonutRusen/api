<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::get('{any?}', fn() => view('welcome'))->where('any', '^(?!api).*$');;

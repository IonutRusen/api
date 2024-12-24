<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('dashboard');

require __DIR__ . '/auth.php';

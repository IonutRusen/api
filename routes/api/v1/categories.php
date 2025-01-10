<?php

declare(strict_types=1);
use App\Http\Controllers\v1\Categories;


Route::post('/', Categories\IndexController::class)->middleware('allow:post');


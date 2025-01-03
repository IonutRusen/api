<?php

declare(strict_types=1);


use App\Http\Controllers\v1\Companies\IndexController;
use App\Http\Controllers\v1\Companies\ShowController;
use App\Http\Controllers\v1\Companies\StoreController;

Route::get('/', IndexController::class)->middleware('allow:get');
Route::post('/', StoreController::class)->middleware('allow:post');
Route::get('/{company}', ShowController::class)->middleware('allow:get');

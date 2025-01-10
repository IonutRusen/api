<?php

declare(strict_types=1);
use App\Http\Controllers\v1\Companies\Addresses;


Route::post('/', Addresses\StoreController::class)->middleware('allow:post');
Route::get('/', Addresses\IndexController::class)->middleware('allow:get');
Route::get('/{address}', Addresses\ShowController::class)->middleware('allow:get');
Route::put('/{address}', Addresses\UpdateController::class)->middleware('allow:put');


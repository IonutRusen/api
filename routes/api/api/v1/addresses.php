<?php

declare(strict_types=1);


use App\Http\Controllers\v1\Companies\Addresses\StoreController;

Route::post('/', StoreController::class)->middleware('allow:post');


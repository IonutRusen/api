<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Services;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;

final readonly class WriteRequest
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    /**
     * @throws \Throwable
     */
    public function handle(object $payload, string $class, ?Model $existingModel = null): Model
    {
        return $this->database->transaction(
            callback: fn() => $existingModel
                 ? $existingModel->update(
                     attributes: $payload->toArray(),
                 )
                 : $class::create(
                     attributes: $payload->toArray(),
                 ),
        );
    }
}

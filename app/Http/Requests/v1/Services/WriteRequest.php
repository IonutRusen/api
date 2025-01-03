<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Services;

use App\Models\Company;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;

final  readonly class WriteRequest
{
    public function __construct(
        private DatabaseManager $database,
    ) {}

    public function handle(object $payload, string $class, Model $exisitingModel = null): void
    {
       $this->database->transaction(
            callback: fn() => $exisitingModel
                ? $exisitingModel->update(
                    attributes: $payload->toArray(),
                )
                : $class::create(
                    attributes: $payload->toArray(),
                ),
        );
    }
}

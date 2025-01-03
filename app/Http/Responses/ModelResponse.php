<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\Status;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use TiMacDonald\JsonApi\JsonApiResource;

final readonly class ModelResponse implements Responsable
{
    public function __construct(
        private JsonResource|JsonApiResource $model,
        private Status $status = Status::OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->model,
            status: $this->status->value,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\Status;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use TiMacDonald\JsonApi\JsonApiResourceCollection;

final readonly class CollectionResponses implements Responsable
{
    public function __construct(
        private JsonApiResourceCollection|ResourceCollection $data,
        private Status $status = Status::OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->data,
            status: $this->status->value,
        );
    }
}

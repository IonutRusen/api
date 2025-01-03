<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\Status;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final readonly class CollectionResponse implements Responsable
{
    /**
     * @param AnonymousResourceCollection $data
     * @param Status $status
     */
    public function __construct(
        private AnonymousResourceCollection $data,
        private Status $status = Status::OK,
    ) {
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->data,
            status: $this->status->value,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\ErrorCodes;
use App\Enums\Status;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

final readonly class ApiErrorResponse implements Responsable
{
    public function __construct(
        private string     $title,
        private string     $description,
        private ErrorCodes $code,
        private Status     $status = Status::INTERNAL_SERVER_ERROR,
    ) {}
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                'title' => $this->title,
                'description' => $this->description,
                'code' => $this->code,
                $this->status->value,
            ],
            status: $this->status->value,
        );
    }
}

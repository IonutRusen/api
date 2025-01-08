<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Companies;

use App\ApiResponses\ApiError;
use App\Enums\Status;
use App\Http\Requests\v1\Company\CompanyRequest;
use App\Http\Requests\v1\Services\WriteRequest;
use App\Http\Resources\v1\CompanyResource;
use App\Http\Responses\ApiErrorResponse;
use app\Http\Responses\ModelResponse;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;
use Throwable;

final class UpdateController
{
    public function __invoke(CompanyRequest $request, Company $company): Responsable
    {

        $writeRequest = resolve(WriteRequest::class);

        try {
            $writeRequest->handle(
                payload: $request->payload(),
                class: Company::class,
                existingModel: $company,
            );


        } catch (Throwable $exception) {
            new ApiErrorResponse(
                data: new ApiError(
                    title: 'Not Found',
                    detail: $exception->getMessage(),
                    instance: $request->path(),
                    code: (string)Status::NOT_FOUND->value,
                    link: 'https://docs.domain.com/errors/not-found',
                ),
                status: Status::NOT_FOUND,
            );
        }
        return new ModelResponse(
            new CompanyResource(
                resource: $company->refresh(),
            ),
        );


    }
}

<?php

namespace App\Http\Controllers\v1\Companies;

use App\ApiResponses\ApiError;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Payloads\v1\Company\CreateCompanyPayload;
use App\Http\Requests\v1\Company\CompanyRequest;
use App\Http\Requests\v1\Services\WriteRequest;
use App\Http\Resources\v1\CompanyResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ErrorResponse;
use app\Http\Responses\ModelResponse;
use App\Models\Company;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final class UpdateController
{


    public function __invoke(CompanyRequest $request, Company $company): Responsable
    {

        $writeRequest = resolve(WriteRequest::class);

        try {
            $writeRequest->handle(
                payload: $request->payload(),
                class: Company::class,
                exisitingModel: $company
            );


        } catch (\Throwable $exception) {
            new ApiErrorResponse(
                data: new ApiError(
                    title: 'Not Found',
                    detail: $exception->getMessage(),
                    instance: $request->path(),
                    code: Status::NOT_FOUND->value,
                    link: 'https://docs.domain.com/errors/not-found',
                ),
                status: Status::NOT_FOUND,
            );
        }
        return new ModelResponse(
            new CompanyResource(
                resource: $company->refresh()
            ),
        );


    }
}

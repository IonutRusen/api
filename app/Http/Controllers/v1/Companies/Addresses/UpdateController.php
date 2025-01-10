<?php

namespace App\Http\Controllers\v1\Companies\Addresses;

use App\ApiResponses\ApiError;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\Addresses\CompanyAddressRequest;
use App\Http\Requests\v1\Services\WriteRequest;
use App\Http\Resources\v1\CompanyAddressResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ModelResponse;
use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Contracts\Support\Responsable;
use Throwable;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompanyAddressRequest $request,Company $company, CompanyAddress $address): Responsable
    {

        $writeRequest = resolve(WriteRequest::class);

        try {
            $writeRequest->handle(
                payload: $request->payload(),
                class: CompanyAddress::class,
                existingModel: $address,
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
            new CompanyAddressResource(
                resource: $address->refresh(),
            ),
        );

    }
}

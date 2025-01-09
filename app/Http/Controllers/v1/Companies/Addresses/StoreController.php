<?php

namespace App\Http\Controllers\v1\Companies\Addresses;

use App\ApiResponses\ApiError;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Company\Addresses\CompanyAddressRequest;
use App\Http\Requests\v1\Company\CompanyRequest;
use App\Http\Requests\v1\Services\WriteRequest;
use App\Http\Resources\v1\CompanyAddressResource;
use App\Http\Resources\v1\CompanyResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ModelResponse;
use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Throwable;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompanyAddressRequest $request, Company $company): Responsable
    {
        $writeRequest = resolve(WriteRequest::class);

        try {
            return new ModelResponse(
                new CompanyAddressResource(
                    resource: $writeRequest->handle(
                        payload: $request->payload(),
                        class: CompanyAddress::class,
                    ),
                ),
            );


        } catch (Throwable $exception) {
          return  new ApiErrorResponse(
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
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Companies;

use App\Http\Requests\v1\Company\WriteRequest;
use App\Http\Responses\v1\MessageResponse;
use App\Jobs\v1\Company\CreateNewCompany;
use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\HttpFoundation\Response;

final readonly class StoreController
{
    public function __construct(
        private Dispatcher $bus,
    ) {}
    public function __invoke(WriteRequest $request)

    {

        $this->bus->dispatch(
            command: new CreateNewCompany(
               payload: $request->payload(),

            ),
        );

        return new MessageResponse(
            message: __('services.v1.create.success'),
            status: Response::HTTP_ACCEPTED,
        );
    }
}

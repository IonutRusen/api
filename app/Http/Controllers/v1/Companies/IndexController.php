<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Companies;

use App\Http\Resources\v1\CompanyResource;
use App\Http\Responses\CollectionResponses;
use App\Queries\v1\FetchCompanies;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final readonly class IndexController
{
    public function __construct(
        private FetchCompanies $query,
    ) {}

    public function __invoke(Request $request): Responsable
    {
        return new CollectionResponses(
            data: CompanyResource::collection(
                resource: $this->query->handle(
                    includes: ['company'],
                    filters: ['status'],
                )->get(),
            ),
        );
    }
}

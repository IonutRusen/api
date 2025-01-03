<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Companies;

use App\Http\Resources\v1\CompanyResource;
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
        return  CompanyResource::collection(
            resource: $this->query->handle(
                allowedIncludes: ['addresses'],
                filters: ['status'],
                sortBy: $request->input('sortBy'),
                order: $request->input('orderBy'),
            )->paginate(
                perPage: $request->input('itemsPerPage') ?? config('app.per_page'),
                page: $request->input('page'),
            ),
        );
    }
}

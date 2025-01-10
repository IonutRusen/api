<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\Companies;

use App\Http\Resources\v1\CompanyResource;
use App\Models\Company;
use App\Queries\v1\FetchCompanies;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final readonly class ShowController
{
    public function __construct(
        private FetchCompanies $query,
    ) {}

    public function __invoke(Request $request, Company $company): Responsable
    {

        if ( $request->user()->cannot('view', $company)) {
            abort(403);
        };


        return  CompanyResource::make(
            resource: $this->query->handle(
                allowedIncludes: ['addresses.category'],
            )->find(
                $company->id,
            ),
        );



    }
}

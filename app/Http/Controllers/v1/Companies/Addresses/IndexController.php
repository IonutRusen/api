<?php

namespace App\Http\Controllers\v1\Companies\Addresses;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CompanyAddressResource;
use App\Models\Company;
use App\Queries\v1\FetchCompanyAdrresses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(
        private FetchCompanyAdrresses $query,
    ) {}

    public function __invoke(Request $request, Company $company): Responsable
    {
        return  CompanyAddressResource::collection(
            resource: $this->query->handle(
                allowedIncludes: ['addresses'],
                filters: ['status'],
                sortBy: $request->input('sortBy'),
                order: $request->input('orderBy'),
            )
                ->where('company_id', $company->id)
                ->get(),
        );
    }
}

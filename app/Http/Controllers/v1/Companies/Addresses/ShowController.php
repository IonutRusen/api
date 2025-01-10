<?php

namespace App\Http\Controllers\v1\Companies\Addresses;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CompanyAddressResource;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Queries\v1\FetchCompanies;
use App\Queries\v1\FetchCompanyAdrresses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function __invoke(Request $request,Company $company,CompanyAddress $address): Responsable
    {


        if (  $request->user()->cannot('view', $address)) {
            abort(403);
        };


        return  CompanyAddressResource::make(
            resource: $address,
        );
    }
}

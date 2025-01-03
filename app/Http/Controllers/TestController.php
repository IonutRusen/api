<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\v1\CompanyResource;
use App\Queries\v1\FetchCompanies;
use Illuminate\Http\Request;

final class TestController extends Controller
{
    public function __construct(
        private FetchCompanies $query,
    ) {}
    public function __invoke(Request $request)
    {

        return  CompanyResource::collection(
            resource: $this->query->handle(
                includes: ['addresses'],
                sortBy: $request->input('sortBy'),
                order: $request->input('orderBy'),
            )->paginate(
                perPage: $request->input('itemsPerPage') ?? config('app.per_page'),
                page: $request->input('page'),
            ),
        );
    }
}

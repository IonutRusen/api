<?php

namespace App\Http\Controllers\v1\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CategoryResource;
use App\Queries\v1\FetchCategories;
use App\Queries\v1\FetchCompanies;
use Illuminate\Http\Request;

final readonly class IndexController
{
    public function __construct(
        private FetchCategories $query,
    ) {}

    public function __invoke(Request $request)
    {
        return  CategoryResource::collection(
            resource: $this->query->handle(
                order: $request->input('orderBy'),
                parentId: $request->input('parent_id'),

            )->get(),
        );
    }
}

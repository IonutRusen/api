<?php

namespace App\Queries\v1;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final class FetchCompanies
{
    public function handle(array $includes = [], $filters = []): Builder
    {
        return QueryBuilder::for(
            subject: Company::query(),
        )->allowedIncludes(
            includes: $includes,
        )->allowedFilters(
            filters: $filters,
        )->where('user_id', auth()->id())
            ->getEloquentBuilder();
    }
}
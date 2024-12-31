<?php

declare(strict_types=1);

namespace App\Queries\v1;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final class FetchCompanies
{
    public function handle(array $includes = [], $filters = [], $sortBy = null, $order = 'asc'): Builder
    {

        $q = QueryBuilder::for(
            subject: Company::query(),
        )
            ->allowedSorts('name', 'street')
            ->allowedIncludes(
                includes: $includes,
            )->allowedFilters(
                filters: $filters,
            )->where('user_id', auth()->id());

        if ($sortBy) {
            $q->orderBy($sortBy ?? 'name', $order);
        }
        return $q->getEloquentBuilder();
    }
}

<?php

declare(strict_types=1);

namespace App\Queries\v1;

use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final class FetchCompanyAdrresses
{
    public function handle(array $allowedIncludes = [], $filters = [], $sortBy = null, $order = 'asc'): Builder
    {

        $q = QueryBuilder::for(
            subject: CompanyAddress::query(),
        )
            ->allowedSorts('name', 'street')
            ->allowedIncludes(
                includes: $allowedIncludes,
            )->allowedFilters(
                filters: $filters,
            )
           ;

        if ($sortBy) {
            $q->orderBy($sortBy ?? 'name', $order);
        }
        return $q->getEloquentBuilder();
    }
}

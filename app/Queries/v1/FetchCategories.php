<?php

declare(strict_types=1);

namespace App\Queries\v1;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final class FetchCategories
{
    public function handle(array $allowedIncludes = [], $filters = [], $sortBy = null, $order = 'asc', $parentId = null): Builder
    {

        $q = QueryBuilder::for(
            subject: Category::query(),
        )
            ->allowedSorts('name', 'street')
            ->allowedIncludes(
                includes: $allowedIncludes,
            )->allowedFilters(
                filters: $filters,
            )
            ->where('parent_id', $parentId)
          ;

        if ($sortBy) {
            $q->orderBy($sortBy ?? 'title', $order);
        }
        return $q->getEloquentBuilder();
    }
}

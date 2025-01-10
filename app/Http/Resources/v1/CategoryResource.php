<?php

declare(strict_types=1);

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

final class CategoryResource extends JsonApiResource
{

    public function toAttributes(Request $request): array
    {
        return [
            'title' => $this->title,
            'alias' => $this->alias,
        ];
    }
}

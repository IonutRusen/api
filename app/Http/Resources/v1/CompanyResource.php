<?php

declare(strict_types=1);

namespace App\Http\Resources\v1;

use App\Http\Resources\DateResource;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

final class CompanyResource extends JsonApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public array $relationsShips = [];
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'logo' => $this->logo,
            'created' => new DateResource(
                resource: $this->created_at,
            ),

        ];
    }
}

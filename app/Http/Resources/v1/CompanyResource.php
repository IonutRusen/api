<?php

declare(strict_types=1);

namespace App\Http\Resources\v1;

use App\Http\Resources\DateResource;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property mixed $created_at
 * @property mixed $name
 *
 */
final class CompanyResource extends JsonApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toRelationships($request): array
    {
        return [
            'addresses' => fn () => CompanyAddressResource::collection($this->addresses),

        ];
    }

    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'website' => $this->website,
            'description' => $this->description,
            'created' => new DateResource(
                resource: $this->created_at,
            )


        ];
    }


}

<?php

declare(strict_types=1);

namespace App\Http\Resources\v1;

use App\Http\Resources\DateResource;
use App\Models\CompanyAddress;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

/**
 * @property mixed $created_at
 * @property mixed $name
 * @property mixed $website
 * @property mixed $logo
 */
final class CompanyResource extends JsonApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'website' => $this->website,
            'logo' => $this->logo,
            'created' => new DateResource(
                resource: $this->created_at,
            ),
            'relationship' => [
                'addresses' => $this->whenLoaded( relationship: 'addresses'),
            ],

        ];
    }


}

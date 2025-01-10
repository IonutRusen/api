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

    public $relationships = [
        'addresses' => CompanyAddressResource::class,
    ];
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'website' => $this->website,
            'description' => $this->description,
            'created' => new DateResource(
                resource: $this->created_at,
            ),/* 'relationship' => [
                'addresses' => $this->whenLoaded(
                    'addresses',
                    CompanyAddressResource::collection($this->addresses),
                ),
            ],*/


        ];
    }


}

<?php

declare(strict_types=1);

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

final class CompanyAddressResource extends JsonApiResource
{


    public function toAttributes(Request $request): array
    {

        return [
            'company_id' => $this->company_id,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'location' => $this->location,

            'relationship' => [ 'category' => $this->relationLoaded('category') ? CategoryResource::make($this->category) : null],


        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Payloads\v1\Company\Addresses;


use MatanYadaev\EloquentSpatial\Objects\Point;

final readonly class CreateCompanyAddressPayload
{
    public function __construct(
        private string $company_id,
        private string $address,
        private string $city,
        private string $state,
        private string $zip,
        private string $country,
        private string $phone,
        private string $email,
        private Point $location,
    ) {}

    public function toArray(): array
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
            'location' => $this->location,

        ];

    }
}

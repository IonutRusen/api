<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Company\Addresses;

use App\Http\Payloads\v1\Company\Addresses\CreateCompanyAddressPayload;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Foundation\Http\FormRequest;


final class CompanyAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_id' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|max:255',
            'state' => 'required|string|min:2|max:255',
            'zip' => 'required|string|min:2|max:255',
            'country' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:2|max:255',
            'email' => 'required|string|min:2|max:255',
            'lat' => 'required',
            'lng' => 'required',
        ];

    }

    /**
     * @return CreateCompanyAddressPayload
     */
    public function payload(): CreateCompanyAddressPayload
    {
        $location = new Point(
            latitude:  $this->string('lat')->toFloat(),
            longitude: $this->string('lng')->toFloat(),
        );
        return new CreateCompanyAddressPayload(
            company_id: $this->string('company_id')->toString(),
            address: $this->string('address')->toString(),
            city: $this->string('city')->toString(),
            state: $this->string('state')->toString(),
            zip: $this->string('zip')->toString(),
            country: $this->string('country')->toString(),
            phone: $this->string('phone')->toString(),
            email: $this->string('email')->toString(),
            location: $location,


        );
    }
}

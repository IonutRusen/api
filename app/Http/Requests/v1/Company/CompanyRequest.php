<?php

declare(strict_types=1);

namespace App\Http\Requests\v1\Company;

use App\Http\Payloads\v1\Company\CreateCompanyPayload;
use Illuminate\Foundation\Http\FormRequest;

final class CompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|min:2|max:255',
            'website' => 'required|url|min:11|max:255',
            'description' => 'required|string|min:2|max:255',
        ];

    }

    public function payload(): CreateCompanyPayload
    {
        return new CreateCompanyPayload(
            name: $this->string('name')->toString(),
            email: $this->string('email')->toString(),
            website: $this->string('website')->toString(),
            description: $this->string('description')->toString(),
            user: $this->user()->id,
        );
    }
}

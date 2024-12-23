<?php

declare(strict_types=1);

namespace App\Http\Payloads\v1\Company;

final readonly class CreateCompanyPayload
{
    public function __construct(
        private string $name,
        private string $email,
        private string $website,
        private string $description,
        private string $user,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'website' => $this->website,
            'description' => $this->description,
            'user_id' => $this->user,
        ];

    }
}

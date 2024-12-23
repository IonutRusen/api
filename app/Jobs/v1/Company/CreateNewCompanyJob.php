<?php

declare(strict_types=1);

namespace App\Jobs\v1\Company;

use App\Http\Payloads\v1\Company\CreateCompanyPayload;
use App\Models\Company;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

final class CreateNewCompanyJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly CreateCompanyPayload $payload,
    ) {}

    /**
     * Execute the job.
     * @throws Throwable
     */
    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn() => Company::query()->create(
                attributes: $this->payload->toArray(),
            ),
            attempts: 2,
        );
    }
}

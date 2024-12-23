<?php

namespace App\Jobs\v1\Company;

use App\Http\Payloads\v1\Company\CreateCompany;
use App\Models\Company;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

class CreateNewCompany implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly CreateCompany $payload,
    )
    {
        //
    }

    /**
     * Execute the job.
     * @throws \Throwable
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

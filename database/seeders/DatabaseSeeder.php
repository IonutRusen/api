<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory(20)->create();

        Company::factory()->times(500)->create();
        foreach (Company::all() as $company) {
            CompanyAddress::factory()->times(2)->create([
                'company_id' => $company->id,
            ]);
        }

        //seed Categories
        $this->call(
            class : [
                CategorySeeder::class
            ]
        );
    }
}

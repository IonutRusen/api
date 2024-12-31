<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\State;
use App\Modules\Company\Model\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a company.
     *
     * @return void
     */
    public function test_create_company()
    {
        // Consistent fake data
        $name = fake()->name();
        $address = fake()->address();
        $postcode = fake()->postcode();
        $phoneNumber = fake()->phoneNumber();
        $ein = fake()->randomNumber(9);
        $state_id = State::inRandomOrder()->first()->id;
        $city_id = City::inRandomOrder()->first()->id;

        // Create company
        $company = Company::factory()->create([
            'name' => $name,
            'corporate_address' => $address,
            'country_id' => 231,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'zip_code' => $postcode,
            'phone_number' => $phoneNumber,
            'ein' => $ein,
        ]);

        // Assert company in database
        $this->assertDatabaseHas('companies', [
            'name' => $name,
            'corporate_address' => $address,
            'country_id' => 231,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'zip_code' => $postcode,
            'phone_number' => $phoneNumber,
            'ein' => $ein,
        ]);
    }

    /**
     * Test reading a company.
     *
     * @return void
     */
    public function test_read_company()
    {
        $company = Company::factory()->create();

        $found = Company::find($company->id);

        $this->assertEquals($company->name, $found->name);
        $this->assertEquals($company->email, $found->email);
        $this->assertEquals($company->address, $found->address);
    }

    /**
     * Test updating a company.
     *
     * @return void
     */
    public function test_update_company()
    {
        $company = Company::factory()->create();
        $state = State::inRandomOrder()->first();
        $city = City::inRandomOrder()->first();
        $zip = fake()->postcode();
        $phone_number = fake()->phoneNumber(); // Corrected typo
        $ein = fake()->randomNumber(9, true); // Fixed format issue
        $email = fake()->email();

        $company->update([
            'name' => 'Updated Company Name',
            'email' => $email, // Use $email variable
            'corporate_address' => fake()->address(),
            'country_id' => 231, //$this->faker->randomNumber(),
            'state_id' => $state->id,
            'city_id' => $city->id,
            'zip_code' => $zip,
            'phone_number' => $phone_number, // Corrected typo
            'ein' => $ein,
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Updated Company Name',
            'email' => $email, // Use $email variable instead of hard-coded value
            'corporate_address' => $company->corporate_address,
            'country_id' => 231,
            'state_id' => $state->id,
            'city_id' => $city->id,
            'zip_code' => $zip,
            'phone_number' => $phone_number, // Corrected typo
            'ein' => $ein,
        ]);
    }

    /**
     * Test deleting a company.
     *
     * @return void
     */
    public function test_delete_company()
    {
        $company = Company::factory()->create();

        // Deleting the Company instance
        $company->delete();

        // Asserting that the Company is deleted
        $this->assertDatabaseMissing($company);
    }
}

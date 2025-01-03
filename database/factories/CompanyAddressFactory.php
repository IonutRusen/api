<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyAddress>
 */
class CompanyAddressFactory extends Factory
{

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
            'country' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'website' => $this->faker->url,
            'location' => new Point(
                latitude: 28.123456,//(float)$this->generateRandomCoordinate(-90, 90),
                longitude:  39.123456,// (float)$this->generateRandomCoordinate(-180, 180),
            ),
        ];
    }

    function generateRandomCoordinate($min, $max)
    {
        return mt_rand($min * 1000000, $max * 1000000) / 1000000.0;
    }
}

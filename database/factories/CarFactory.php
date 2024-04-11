<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Provider\FakeCar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new FakeCar($faker));

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'license_plate' => $faker->vehicleRegistration('[A-Z]{2}-[0-9]{2}-[0-9]{2}'),
            'brand' => $faker->vehicleBrand,
            'model' => $faker->vehicleModel,
            'price' => $faker->randomFloat(2, 1000, 100000),
            'mileage' => $faker->numberBetween(1000, 100000),
            'seats' => $faker->vehicleSeatCount,
            'doors' => $faker->vehicleDoorCount,
        ];
    }
}

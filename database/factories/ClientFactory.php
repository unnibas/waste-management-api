<?php

namespace Database\Factories;

use App\Models\Client;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'description' => $this->faker->paragraph(1),
            'address' => $this->faker->address(),
            'pincode' => Str::random(6),
            'status' => $this->faker->randomElement([Client::ACTIVE_CLIENT,Client::INACTIVE_CLIENT]),
        ];
    }
}

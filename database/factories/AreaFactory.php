<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'client_id' => Client::all()->random()->id,
            'logo_url' => $this->faker->randomElement(['1.jpg','2.jpg','3.jpg']),
            'description' => $this->faker->paragraph(1),
        ];
    }
}

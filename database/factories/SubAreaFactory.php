<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\SubArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'nick_name' => $this->faker->word(),
            'logo_url' => $this->faker->randomElement(['1.jpg','2.jpg','3.jpg']),
            'description' => $this->faker->paragraph(1),
            'area_id' => Area::all()->random()->id,
        ];
    }
}

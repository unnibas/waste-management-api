<?php

namespace Database\Factories;

use App\Models\CollectionPoint;
use App\Models\SubArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionPointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CollectionPoint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_area_id' => SubArea::all()->random()->id,
            'name' => $this->faker->word(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'card_id' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'barcode' => $this->faker->word(),
            'address' => $this->faker->address(),
            'pincode' => $this-> faker->postcode(),
        ];
    }
}

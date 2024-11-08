<?php

namespace Modules\Staff\Brand\Database\factories;

use Modules\Staff\Brand\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        return [
//            'name' => $this->faker->company,
//            'en_name' => $this->faker->company,
//            'slug' => $this->faker->company,
//            'description' => 'تست',
//            'type'=> rand(0,1),
//        ];
    }
}

<?php

namespace Database\Factories\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;


class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url'=>asset('storage/photos/'.rand(1,3).'.jpg'),
            
        ];
    }
}

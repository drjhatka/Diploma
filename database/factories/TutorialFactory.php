<?php

namespace Database\Factories\Models;

use App\Models\Tutorial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class TutorialFactory extends Factory
{

    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tutorial::class;

    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'post_image'=>'somepostimage.jpg',
            'short_description'=>$this->faker->paragraph(7,false),
            'content_bangla'=>$this->faker->paragraphs(10,true),
            'syllabus_id'=>rand(1,10),
            
        ];
    }
}

<?php

namespace Database\Factories\Models;

use App\Models\Syllabus;
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

    public $syllabus= null;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'post_image'=>asset('storage/photos/'.rand(1,3).'.jpg'),
            'short_description'=>$this->faker->paragraph(7,false),
            'content_bangla'=>$this->faker->paragraphs(10,true),
            'syllabus_id' =>function(){
                $this->syllabus =Syllabus::find(rand(1,10));
                return $this->syllabus->id;
            },
            'paper'=>function(){
                return $this->syllabus->subject;
            }
        ];
    }
}

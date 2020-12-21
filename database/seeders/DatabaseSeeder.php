<?php

namespace Database\Seeders;

use App\Models\Syllabus;
use App\Models\Image;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         //\App\Models\Syllabus::factory()->create();
         $this->call(SyllabusTableSeeder::class);

    //
         \App\Models\Tutorial::factory(10)->create()->each(function($tutorial){            
             $tutorial->images()->save(
                 Image::factory()->make([
                    'imageable_id'=>$tutorial->id,
                    'imageable_type'=>Image::class
                 ])
             );

         });

    }
}

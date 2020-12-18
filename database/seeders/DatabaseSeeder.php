<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Syllabus;
use Database\Factories\Models\SyllabusFactory;
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
    }
}

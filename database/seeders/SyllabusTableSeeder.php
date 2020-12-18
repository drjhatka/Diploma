<?php

namespace Database\Seeders;

use App\Models\Syllabus;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SyllabusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'subject'=>'eco',
            'topic'=>'Concepts of Economics & Demand Supply Analysis',
            'module'=>'A'],

            ['subject'=>'eco',
            'topic'=>'Production, Cost & Market Structure',
            'module'=>'B'],

        ['subject'=>'eco',
        'topic'=>'Macroeconomics',
        'module'=>'C'],

        ['subject'=>'eco',
        'topic'=>'Bangladesh Economy',
        'module'=>'D'],
//Business Communication

//Accounting
        ['subject'=>'acct',
        'topic'=>'Introduction & Environment',
        'module'=>'A'],

        ['subject'=>'acct',
        'topic'=>'Analysis of Financial Statement',
        'module'=>'B'],

        ['subject'=>'acct',
        'topic'=>'Processing & Recording of Accounting Information',
        'module'=>'C'],

        ['subject'=>'acct',
        'topic'=>'Financial Statements for Different Entities',
        'module'=>'D'],

        ['subject'=>'acct',
        'topic'=>'Accounting for Asset',
        'module'=>'E'],

        ['subject'=>'acct',
        'topic'=>'Journal Rules for Journalizing',
        'module'=>'E'],
        ];

        foreach ($data as $item) {
            Syllabus::create($item);
        }
        //App\Models\Syllabus::factory(App\User::class)->make()->create();
    }
}

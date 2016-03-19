<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('SurveysTableSeeder');
        $this->call('GroupsTableSeeder');
        $this->call('QuestionsTableSeeder');
        $this->call('ArrayQuestionsTableSeeder');
        $this->call('AnswersTableSeeder');
    }
}

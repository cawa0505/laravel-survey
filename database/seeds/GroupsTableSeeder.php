<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Survey;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faker = Faker::create('en_GB');
        $surveys = array_flatten(Survey::all(['id'])->toArray());
        foreach (range(1,20) as $index) {
            DB::table('groups')->insert([
                'survey_id' => $faker->randomElement($surveys),
                'text' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'small_text' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                'order' => $faker->numberBetween(1, 99),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}

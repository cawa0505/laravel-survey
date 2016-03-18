<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Survey;

class SurveysTableSeeder extends Seeder
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
        foreach (range(1,20) as $index) {
            DB::table('surveys')->insert([
                'slug' => str_replace(" ", "-", str_replace(["?", "'", '"', "!", "&", "£", "$", ",", "(", ")", "."], "", strtolower($faker->text($maxNbChars = 20)))),
                'text' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'small_text' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                'admin_name' => $faker->name,
                'admin_email' => strtolower($faker->email),
                'active' => $faker->boolean,
                'expires' => $faker->dateTimeBetween('now', '1 year'),
                'startdate' => $faker->dateTimeBetween('-1 year', 'now'),
                'anonymized' => $faker->boolean,
                'allow_registration' => $faker->boolean,
                'description_text' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                'welcome_text' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'end_text' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                'url_callback' => $faker->url,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}

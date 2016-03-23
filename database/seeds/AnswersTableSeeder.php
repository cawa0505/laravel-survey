<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Models\Question;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list_scaler_question_ids = Question::whereIn('type', ['list_radio', 'gender', 'dropdown'])->get()->toArray();

		$answer_scales = [
			"satisfied" => [
				1 => [
					"very-dissatisfied",
					"Very dissatisfied",
				],
				2 => [
					"dissatisfied",
					"Dissatisfied",
				],
				3 => [
					"neither",
					"Neither satisfied nor dissatisfied",
				],
				4 => [
					"satisfied",
					"Satisfied",
				],
				5 => [
					"very-satisfied",
					"Very satisfied",
				],
			],
			"agree" => [
				1 => [
					"strongly-disagree",
					"Strongly disagree",
				],
				2 => [
					"disagree",
					"Disagree",
				],
				3 => [
					"neither",
					"Neither agree nor disagree",
				],
				4 => [
					"agree",
					"Agree",
				],
				5 => [
					"strongly-agree",
					"Strong agree",
				],
			],
			"gender" => [
				1 => [
					"male",
					"Male",
				],
				2 => [
					"female",
					"Female",
				],
			],
			"disability" => [
				1 => [
					"no-known-disability",
					"No known disability",
				],
                2 => [
                	"specific-learning-difficulty",
                	"Specific learning difficulty (such as dyslexia)",
                ],
                3 => [
                	"autism-spectrum-condition",
                	"Autism spectrum condition",
                ],
                4 => [
                	"mobility-impairment",
                	"Mobility impairment",
                ],
                5 => [
                	"sensory-impairment",
                	"Sensory impairment",
                ],
                6 => [
                	"long-term-physical-health-condition",
                	"Long term physical health condition",
                ],
                7 => [
                	"long-term-mental-health-condition",
                	"Long term mental health condition",
                ],
			],
		];

		$faker = Faker::create('en_GB');

    	foreach ($list_scaler_question_ids as $column => $value) {

            $key = array_rand($answer_scales);
			$answer_scale = $answer_scales[$key];

			foreach ($answer_scale as $scale_value => $details) {
				DB::table('answers')->insert([
					'question_id' => $value["id"],
					'value' => $scale_value,
					'code' => $details[0],
					'text' => $details[1],
					'visable' => $faker->boolean,
					'order' => $faker->numberBetween(1, 99),
					'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
	            	'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
				]);
			}
    	}
    }
}

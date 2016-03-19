<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Group;
use App\Question;

class ArrayQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
        	"How do you feel about all of this?" => [
                "I’ve been feeling relaxed",
                "I’ve been dealing with problems well",
                "I am able to visit parks or countryside whenever I want"
            ],
        ];

        $faker = Faker::create('en_GB');
        $groups = array_flatten(Group::all(['id'])->toArray());

        foreach ($questions as $main_question => $sub_question) {

        	$parent_random_group_id = $faker->randomElement($groups);

        	DB::table('questions')->insert([
                'parent_question_id' => null,
                'group_id' => $parent_random_group_id,
                'text' => $main_question,
                'type' => "array",
                'order' => $faker->numberBetween(1, 99),
                'mandatory' => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            $question = Question::where('text', $main_question)->first();

            foreach ($sub_question as $a_sub_question) {
                DB::table('questions')->insert([
                    'parent_question_id' => $question->id,
                    'group_id' => $parent_random_group_id,
                    'text' => $a_sub_question,
                    'order' => $faker->numberBetween(1, 99),
                    'mandatory' => $faker->boolean,
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ]);
            }
        }
    }
}

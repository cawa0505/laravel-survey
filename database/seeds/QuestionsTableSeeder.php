<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Group;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $questions = [
            "Overall, how satisfied are you with your work?" => ["list_radio"],
            "Overall, I am satisfied with the quality of the course" => ["list_radio"],
            "Disability." => ["list_radio"],
            "Nationality" => ["list_radio"],
            "Age" => ["list_radio"],
            "Employment status" => ["dropdown"],
            "Ethnicity" => ["dropdown"],
            "Do you have a friend or family member with whom you can discuss personal matters?" => ["yes_no"],
            "Have either of your parents attended University" => ["yes_no"],
            "What could the Uni stop doing to improve well-being?" => ["huge_free_text"],
            "What could the Uni start doing to improve well-being?" => ["huge_free_text"],
            "Postcode" => ["short_free_text"],
            "Email" => ["short_free_text"],
            "Gender" => ["gender"],
            "Income (£0000)" => ["numerical"],
        ];

        $faker = Faker::create('en_GB');
        $groups = array_flatten(Group::all(['id'])->toArray());

        foreach ($questions as $the_question => $values) {
            DB::table('questions')->insert([
                'parent_question_id' => null,
                'group_id' => $faker->randomElement($groups),
                'text' => $the_question,
                'type' => $values[0],
                'order' => $faker->numberBetween(1, 99),
                'mandatory' => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}

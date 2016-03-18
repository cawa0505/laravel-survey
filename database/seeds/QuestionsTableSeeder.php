<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Group;

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
            "How do you feel about all of this?" => [
                "parent", [
                    "I’ve been feeling relaxed",
                    "I’ve been dealing with problems well",
                    "I am able to visit parks or countryside whenever I want"
                ]
            ],
            "I’ve been feeling relaxed" => ["array"],
            "I’ve been dealing with problems well" => ["array"],
            "I am able to visit parks or countryside whenever I want" => ["array"],
            "Overall, how satisfied are you with your work?" => ["list_radio"],
            "Overall, I am satisfied with the quality of the course" => ["list_radio"],
            "I feel part of a community of staff and students." => ["list_radio"],
            "Disability." => ["list_radio"],
            "Nationality" => ["list_radio"],
            "Primary Academic School" => ["list_radio"],
            "Level of study" => ["list_radio"],
            "Year of programme" => ["list_radio"],
            "Accommodation" => ["list_radio"],
            "I am able to get to places I need without difficulty" => ["list_radio"],
            "Overall, how satisfied are you with your accommodation?" => ["list_radio"],
            "How often do you spend 15 minutes walking or cycling?" => ["list_radio"],
            "How often do you attend courses of some kind?" => ["list_radio"],
            "How often do you spend time informally learning about something new?" => ["list_radio"],
            "I see beauty around me, even in small things?" => ["list_radio"],
            "Place" => ["list_radio"],
            "I can laugh and see the funny side of things?" => ["list_radio"],
            "Age" => ["list_radio"],
            "Employment status" => ["list_radio"],
            "Ethnicity" => ["list_radio"],
            "Do you have a friend or family member with whom you can discuss personal matters?" => ["yes_no"],
            "My personal tutor/academic-adviser/supervisor is approachable and helpful when I contact and meet with them." => ["yes_no"],
            "Have either of your parents attended University" => ["yes_no"],
            "What one thing could the University stop doing to improve support for student well-being?" => ["huge_free_text"],
            "What one thing could the University start doing to improve support for student well-being?" => ["huge_free_text"],
            "Postcode" => ["short_free_text"],
            "Email" => ["short_free_text"],
            "Gender" => ["gender"],
            "Income (£0000)" => ["numerical"],
        ];

        $faker = Faker::create('en_GB');
        $groups = array_flatten(Group::all(['id'])->toArray());

        foreach ($questions as $the_question => $values) {

            $random_group = $faker->randomElement($groups);

            if($values[0] == "parent") {

                $parent_random_group = $faker->randomElement($groups);

                DB::table('questions')->insert([
                    'parent_question_id' => null,
                    'group_id' => $parent_random_group,
                    'text' => $the_question,
                    'type' => "array",
                    'order' => $faker->numberBetween(1, 99),
                    'mandatory' => $faker->boolean,
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ]);

            } elseif($values[0] == "array") {

                DB::table('questions')->insert([
                    'parent_question_id' => 1,
                    'group_id' => $parent_random_group,
                    'text' => $the_question,
                    'order' => $faker->numberBetween(1, 99),
                    'mandatory' => $faker->boolean,
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
                ]);

            } else {

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
}

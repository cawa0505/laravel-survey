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
        //$this->call('QuestionsTableSeeder');
        //$this->call('AnswersTableSeeder');



        // $this->call(UsersTableSeeder::class);
        /*
        //surveys
        id 10
        text Annual survey
        small_text The once a year survey
        admin_contact Mike Lovely

        //groups
        id 2
        survey_id 10
        text Home life
        small_text All about living at home
        slug home_life
        order 1

        //questions
        id 14
        group_id 7
        parent_question_id null
        test Who do you love the most?
        small_text Hint: pick one
        type list_dropdown
        slug who_do_you_love_the_most
        order 1
        mandatory 1
        -----------------
        id 15
        group_id 7
        parent_question_id null
        test What is your postcode?
        small_text Hint: should be valid
        type short_free_text
        slug your_postcode
        order 2
        mandatory 1
        ----------------
        id 16
        group_id 7
        parent_question_id null
        test How satisfied are you with the following?
        small_text null
        type array
        slug satisfied_with_work
        order 3
        mandatory 1
        ***
        id 17
        group_id 7
        parent_question_id 16
        test Your pay.
        small_text null
        type null
        slug null
        order 1
        mandatory 1
        ***
        id 18
        group_id 7
        parent_question_id 16
        test Your holiday allowance
        small_text null
        type null
        slug null
        order 2
        mandatory 1

        //question_attributes
        id 1
        question_id 15
        question_answer_id null
        attribute postcode
        value [regex]

        //answers
        id 3
        question_id 14
        value 1
        code oreo
        text Oreo
        *****
        id 4
        question_id 14
        value 2
        code arrow
        text Arrow
        *****
        id 5
        question_id 14
        value 3
        code sam
        text Sam
        ----------------
        id 6
        question_id 16
        value 1
        code vd
        text Very dissatisfied
        *****
        id 7
        question_id 16
        value 2
        code d
        text Dissatisfied
        *****
        id 8
        question_id 16
        value 3
        code nsnd
        text Neither satisfied nor dissatisfied
        *****
        id 9
        question_id 16
        value 4
        code s
        text Satisfied
        *****
        id 10
        question_id 16
        value 5
        code vs
        text Very satisfied
        */
    }
}

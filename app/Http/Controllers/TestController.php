<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Survey;

class TestController extends Controller
{
    public function test()
    {
    	$survey = Survey::where('id', '14')->first();

    	$groups = $survey->groups;

    	//dd($data);

        //return view('survey.form')
          //      ->with('data', $data);

        foreach ($groups as $group) {

    		$data = $group->questions;

            //dd($data);

            return view('survey.form')
                ->with('data', $data);

    		//foreach ($questions as $question) {
    		//	var_dump($question->text);
    		//	var_dump($question->sub_questions);
    		//}


    	}


    }
}

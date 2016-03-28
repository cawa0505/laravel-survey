<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Survey;
use App\Models\Participant;

class SurveyController extends Controller
{
    public function getStart($slug)
    {
        $survey = Survey::where('slug', $slug)->first();

        return view('survey.welcome')
            ->with('survey', $survey);
    }

    public function postStart()
    {

    }

    public function getGroup($surveySlug, $groupSlug)
    {
        $survey = Survey::getGroupAndQuestions($surveySlug, $groupSlug);

        return view('survey.form')
            ->with('survey', $survey)
            ->with('group', $survey->groups->first());
    }

    public function postGroup($surveySlug, $groupSlug, Request $request)
    {
        $survey = Survey::where('slug', $surveySlug)->first();

        $participant = new Participant;
        $participant->setTable('participants_'.$survey->id);
        $participant = $participant->find(234); //todo - find the session participant

        $attributes = array_keys($participant->getAttributes());

        foreach ($attributes as $key => $column_name) {
            if ($request->input($column_name)) {
                $participant->$column_name = $request->input($column_name);
            }
        }

        $participant->save();
    }

    public function getComplete($slug)
    {
        $survey = Survey::where('slug', $slug)->first();

        return view('survey.complete')
            ->with('survey', $survey);
    }
}

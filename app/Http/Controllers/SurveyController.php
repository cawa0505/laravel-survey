<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Survey;

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
        $survey = Survey::with(['questions' => function($query) use ($groupSlug) {
            $query->where('groups.slug', $groupSlug);
        }, 'groups' => function($query) use ($groupSlug) {
            $query->where('groups.slug', $groupSlug);
        }])->whereSlug($surveySlug)->first();

        return view('survey.form')
            ->with('survey', $survey);
    }

    public function postGroup()
    {

    }

    public function getComplete($slug)
    {
        $survey = Survey::where('slug', $slug)->first();

        return view('survey.complete')
            ->with('survey', $survey);
    }
}

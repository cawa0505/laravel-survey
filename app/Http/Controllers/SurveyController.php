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










    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $surveys = Survey::all();

        return view('surveys.index')
            ->with('surveys', $surveys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            $this->getValidationRules(),
            $this->getValidationMessages()
        );

        $input = $request->input();

        Survey::create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Survey $survey)
    {
        return view('surveys.show')
            ->with('survey', $survey);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Survey $survey)
    {
        //to-do
        //can't edit certain fields if survey is "active"

        return view('surveys.edit')
            ->with('survey', $survey);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Survey $survey)
    {
        $this->validate(
            $request,
            $this->getValidationRules("update"),
            $this->getValidationMessages()
        );

        foreach ($survey->getFillable() as $key) {
            if($request->input($key)) {
                $survey->$key = $request->input($key);
            }
        }

        $survey->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();

        //to-do
        // delete all the associated groups, questions and answers as well. (maybe also the participants table)

        return redirect('admin/surveys');
    }

    private function getValidationRules($method = null)
    {
        $validation_rules = [];

        $validation_rules = [
            'slug' => 'required|alpha_dash|string|unique:surveys',
            'text' => 'required|string',
            'small_text' => 'string',
            'admin_name' => 'required|string|max:100',
            'admin_email' => 'required|email|max:255',
            'active' => 'boolean',
            'expires_at' => 'required|date',
            'starts_at' => 'required|date',
            'anonymized' => 'boolean',
            'allow_registration' => 'boolean',
            'description_text' => 'string',
            'welcome_text' => 'required',
            'end_text' => 'required|',
            'url_callback' => 'url',
        ];

        if($method === "update") {
            $validation_rules['slug'] = 'required|alpha_dash|string';
        }

        return $validation_rules;

    }

    private function getValidationMessages()
    {
        $validation_messages = [];

        $validation_messages = [
            'required' => 'Required field',
            'admin_email.required' => 'An e-mail address is required',
        ];

        return $validation_messages;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Group;
use App\Models\Question;
use App\Models\Survey;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Survey $survey, Group $group)
    {
        $questions = $survey->questions;

        // i don't like this. it should be in a model (question or survey though?)
        $questions = $questions->where('group_id', $group->id)->where('parent_question_id', null);

        /*foreach ($questions as $question) {
            if($question->sub_questions) {
                var_dump($question->sub_questions);
            }
        }*/

        return view('questions.index')
            ->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Survey $survey, Group $group)
    {
        return view('questions.create')
            ->with('survey', $survey)
            ->with('group', $group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Survey $survey, Group $group, Request $request)
    {
        $input = $request->input();

        $input['group_id'] = $group->id;

        $question = Question::create($input);

        return redirect('surveys/'.$survey->id.'/groups/'.$group->id.'/questions/'.$question->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Survey $survey, Group $group, Question $question)
    {
        //$question = $survey->questions()->where('questions.id', $id)->first();

        // to do - make this method in the model. attach to object and do an if
        // statement in the view file. nice!
        //$question->subquestionsRequired()

        return view('questions.show')
            ->with('survey', $survey)
            ->with('group', $group)
            ->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Survey $survey, Group $group, Question $question)
    {
        return view('questions.edit')
            ->with('survey', $survey)
            ->with('group', $group)
            ->with('question', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Survey $survey, Group $group, Question $question)
    {
        foreach ($question->getFillable() as $key) {
            if($request->input($key)) {
                $question->$key = $request->input($key);
            }
        }

        $question->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Survey $survey, Group $group, Question $question)
    {
        $question->delete();

        return redirect('admin/surveys');
    }
}

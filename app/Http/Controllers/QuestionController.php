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
        return view('questions.create');
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

        Question::create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Survey $survey, Group $group, $id)
    {
        $question = $survey->questions()->where('questions.id', $id)->first();

        return view('questions.show')
            ->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

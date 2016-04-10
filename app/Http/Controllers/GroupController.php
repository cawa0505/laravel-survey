<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Survey;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Survey $survey)
    {
        $groups = $survey->groups;

        return view('groups.index')
            ->with('survey', $survey)
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Survey $survey)
    {
        return view('groups.create')
            ->with('survey', $survey);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Survey $survey, Request $request)
    {
        $input = $request->input();

        $input['survey_id'] = $survey->id;

        Group::create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Survey $survey, Group $group)
    {
        //to do - can keep this or change it to an if which throws error
        //$group = $survey->groups()->where('groups.id', $group->id)->first();

        return view('groups.show')
            ->with('survey', $survey)
            ->with('group', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Survey $survey, Group $group)
    {
        return view('groups.edit')
            ->with('survey', $survey)
            ->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Survey $survey, Group $group)
    {
        foreach ($group->getFillable() as $key) {
            if($request->input($key)) {
                $group->$key = $request->input($key);
            }
        }

        $group->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Survey $survey, Group $group)
    {
        $group->delete();

        //to-do
        // delete all the associated groups, questions and answers as well. (maybe also the participants table)
        // redirect back to groups

        return redirect('admin/surveys');
    }
}

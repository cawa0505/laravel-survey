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
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Survey $survey)
    {
        return view('groups.create');
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
    public function show(Survey $survey, $id)
    {
        $group = $survey->groups()->where('groups.id', $id)->first();

        return view('groups.show')
            ->with('group', $group);
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

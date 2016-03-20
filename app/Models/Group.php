<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Survey
{
    protected $fillable = [
        'survey_id',
        'text',
        'small_text',
        'order',
    ];

    public function survey()
    {
    	return $this->belongsTo('App\Models\Survey', 'survey_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'group_id')->whereNull('parent_question_id');
    }
}

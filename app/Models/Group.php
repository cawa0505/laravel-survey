<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Survey
{
    use SoftDeletes;

    protected $fillable = [
        'survey_id',
        'slug',
        'text',
        'small_text',
        'order',
    ];

    protected $dates = ['deleted_at'];

    public function survey()
    {
    	return $this->belongsTo('App\Models\Survey', 'survey_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'group_id')->whereNull('parent_question_id');
    }
}

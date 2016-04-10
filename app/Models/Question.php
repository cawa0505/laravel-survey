<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Group
{
    use SoftDeletes;

    protected $fillable = [
        'parent_question_id',
        'group_id',
        'text',
        'small_text',
        'type',
        'order',
        'mandatory',
    ];

    protected $dates = ['deleted_at'];

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id');
    }

    public function sub_questions()
    {
        return $this->hasMany('App\Models\Question', 'parent_question_id');
    }

    public function parent_question()
    {
        return $this->belongsTo('App\Models\Question', 'id');
    }
}

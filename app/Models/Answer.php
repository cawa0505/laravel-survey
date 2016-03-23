<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Question
{
    protected $fillable = [
        'question_id',
        'value',
        'code',
        'text',
        'visable',
        'order',
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}

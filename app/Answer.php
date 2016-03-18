<?php

namespace App;

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
}

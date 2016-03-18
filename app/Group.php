<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Survey
{
    protected $fillable = [
        'survey_id',
        'text',
        'small_text',
        'order',
    ];
}

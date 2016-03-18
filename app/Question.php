<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Group
{
    protected $fillable = [
        'parent_question_id',
        'group_id',
        'text',
        'small_text',
        'type',
        //'choice','list_dropdown','list_radio','array','date_time','gender','numerical','boilerplate','yes_no','huge_free_text','long_free_text','short_free_text','multiple_choice'
        'order',
        'mandatory',
    ];
}

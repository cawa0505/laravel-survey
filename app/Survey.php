<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'slug',
        'text',
        'small_text',
        'admin_name',
        'admin_email',
        'active',
        'expires',
        'startdate',
        'anonymized',
        'allow_registration',
        'description_text',
        'welcome_text',
        'end_text',
        'url_callback',
    ];
}

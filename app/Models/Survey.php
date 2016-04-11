<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'text',
        'small_text',
        'admin_name',
        'admin_email',
        'active',
        'expires_at',
        'starts_at',
        'anonymized',
        'allow_registration',
        'description_text',
        'welcome_text',
        'end_text',
        'url_callback',
    ];

    protected $dates = ['deleted_at'];

    public function groups()
    {
        return $this->hasMany('App\Models\Group', 'survey_id');
    }

    public function questions()
    {
        return $this->hasManyThrough('App\Models\Question', 'App\Models\Group');
    }

    public static function getGroupAndQuestions($surveySlug, $groupSlug)
    {
        return self::with([
            'questions' => function($query) use ($groupSlug) {
                $query
                    ->where('groups.slug', $groupSlug)
                    ->where('questions.parent_question_id', null);
            },
            'groups' => function($query) use ($groupSlug) {
                $query
                    ->where('groups.slug', $groupSlug)
                    ->first();
            }
        ])
        ->whereSlug($surveySlug)
        ->first();
    }
}

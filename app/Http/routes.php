<?php

Route::get('/', function () {
    echo "welcome";
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {

	Route::resource('surveys', 'SurveyController');

	Route::resource('surveys.groups', 'GroupController');

    Route::resource('surveys.groups.questions', 'QuestionController');

});

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
});

Route::get('/{survey}/welcome', [
    'uses' => 'SurveyController@getStart'
]);

Route::post('/{survey}', [
    'uses' => 'SurveyController@postStart',
    'as' => 'survey.create',
]);

Route::get('/{survey}/complete', [
    'uses' => 'SurveyController@getComplete',
]);

Route::get('/{survey}/{group}', [
    'uses' => 'SurveyController@getGroup'
]);

Route::post('/{survey}/{group}', [
    'uses' => 'SurveyController@postGroup'
]);

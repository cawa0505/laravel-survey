<?php

Route::group(['prefix' => 'admin'], function () {

	Route::resource('surveys', 'SurveyController');

	Route::resource('surveys.groups', 'GroupController');

    Route::resource('surveys.groups.questions', 'QuestionController');

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

Route::get('/admin', [
    'as' =>'admin.index',
    'uses' => 'AdminController@index',
    'middleware' => ['auth'],
]);

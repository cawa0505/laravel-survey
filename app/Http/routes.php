<?php

Route::get('/', [
    'uses' => 'TestController@test'
]);

Route::get('/[survey]/welcome', [
    'uses' => 'SurveyController@getStart'
]);

Route::post('/[survey]/welcome', [
    'uses' => 'SurveyController@postStart'
]);

Route::get('/[survey]/[group]', [
    'uses' => 'SurveyController@getGroup'
]);

Route::post('/[survey]/[group]', [
    'uses' => 'SurveyController@postGroup'
]);

Route::get('/[survey]/complete', [
    'uses' => 'SurveyController@getComplete'
]);

Route::get('/admin', [
    'as' =>'admin.index',
    'uses' => 'AdminController@index',
    'middleware' => ['auth'],
]);

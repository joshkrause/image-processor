<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ImageController@getDimensions'); // get dimensions form

Route::post('/back', 'ImageController@back'); // get dimensions form with old sizes

Route::post('/add-photos', 'ImageController@addPhotos'); // add images form

Route::post('/upload-photos', 'ImageController@uploadPhotos'); //dropzone upload

Route::post('/process', 'ImageController@process'); // crop all uploaded images


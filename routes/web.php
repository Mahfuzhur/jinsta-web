<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','LoginController@index');
Route::get('/instagram-info','LoginController@userLogin');
Route::get('/user-registration','UserController@userRegistration');
Route::get('/registration-success','UserController@registrationSuccess');
Route::post('login','LoginController@login');
Route::post('/instagram-registration','LoginController@InstagramRegistration');
Route::get('/dashboard','UserController@dashboard');
Route::get('/manuscript-registration','UserController@manuscriptRegistration');
Route::get('/create-manuscript','UserController@createManuscript');
Route::get('/hashtag-list','UserController@hashtagList');

Route::post('/save-menuscript-info', 'UserController@saveMenuscriptInfo');
Route::get('/edit-template/{id}', 'UserController@editTemplate');
Route::post('/update-template/{id}', 'UserController@updateTemplate');
Route::get('/destination-registration','UserController@destinationRegistration');
Route::get('/edit-destination-registration/{id}','UserController@editDestinationRegistration');
Route::post('/save-destination-registration/{id}','UserController@saveDestinationRegistration');

Route::get('/create-destination','UserController@hashtagList');
Route::get('/hashtag-manually-add','UserController@createDestination');
// Route::get('/create-destination','UserController@createDestination');
Route::get('/user-login','UserController@userLogin');

Route::post('/save-hashtag-info','UserController@saveHashtagInfo');

Route::get('/download-csv/{hashtagName}','UserController@downloadCSV');

Route::get('/hashtag-list','UserController@hashtagList');
Route::post('/hashtag-list-search','UserController@hashtagListSearch');
Route::post('/hashtag-list-search-csv','UserController@hashtagListSearchCSV');


Route::post('/hashtag-search','UserController@hashtagSearch');
Route::get('/hashtag-selected/{hashtagName}','UserController@hashtagSelected');

Route::get('/delivery-setting','UserController@deliverySetting');
Route::get('/template','UserController@template');
Route::get('/analytics','UserController@analytics');
Route::get('/request','UserController@request');
Route::post('/set-schedule','UserController@SetSchedule');

// Route::get('login','LoginController@login');
Route::get('dm','LoginController@dm');
Route::get('test','LoginController@test');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

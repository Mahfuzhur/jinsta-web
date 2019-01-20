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
Route::get('/user-login','LoginController@userLogin');
Route::get('/user-registration','UserController@userRegistration');
Route::get('/registration-success','UserController@registrationSuccess');
Route::post('login','LoginController@login');
Route::get('/dashboard','UserController@dashboard');
Route::get('/manuscript-registration','UserController@manuscriptRegistration');
Route::get('/create-manuscript','UserController@createManuscript');
Route::get('/destination-registration','UserController@destinationRegistration');
Route::get('/create-destination','UserController@createDestination');
Route::get('/delivery-setting','UserController@deliverySetting');
Route::get('/template','UserController@template');
Route::get('/analytics','UserController@analytics');
Route::get('/request','UserController@request');

// Route::get('login','LoginController@login');
Route::get('dm','LoginController@dm');
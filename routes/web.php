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
Route::get('/delete-destination-registration/{id}','UserController@deleteDestinationRegistration');
Route::get('/delete-template/{id}', 'UserController@deleteTemplate');
Route::get('/create-destination','UserController@hashtagList');

Route::get('/hashtag-manually-add','UserController@createDestination');
Route::get('/compare','UserController@compare');
// Route::get('/create-destination','UserController@createDestination');
Route::get('/user-login','UserController@userLogin');
Route::get('/update-instagram-info','UserController@updateInstagramInfo');
Route::post('/check-update-instagram-info','UserController@checkUpdateInstagramInfo');

Route::post('/save-hashtag-info','UserController@saveHashtagInfo');

Route::get('/download-csv/{hashtagName}','UserController@downloadCSV');

Route::get('/hashtag-list','UserController@hashtagList');
Route::post('/hashtag-list-search','UserController@hashtagListSearch');
Route::post('/hashtag-list-search-csv','UserController@hashtagListSearchCSV');
Route::post('/save-new-hashtag','UserController@saveNewHashtag');


Route::post('/hashtag-search','UserController@hashtagSearch');
Route::get('/hashtag-selected/{hashtagName}','UserController@hashtagSelected');

Route::get('/delivery-setting','UserController@deliverySetting');
Route::get('/template','UserController@template');
Route::get('/analytics','UserController@analytics');
Route::get('/request','UserController@request');
Route::post('/set-schedule','UserController@SetSchedule');

Route::get('/schedule-list','UserController@scheduleList');
Route::post('/schedule-action','UserController@scheduleAction');
Route::get('/schedule-delete/{id}','UserController@scheduleDelete');

Route::post('/save-user-extra-information','UserController@saveUserExtraInformation');

// Route::get('login','LoginController@login');
Route::get('dm','LoginController@dm');
Route::get('test','LoginController@test');


/* Admin Panel Route Start */

Route::get('/admin','AdminController@adminLogin');
Route::post('/admin-login-check','AdminController@adminLoginCheck');
Route::get('/admin-dashboard','AdminController@adminDashboard');
Route::get('/all-company-list','AdminController@allCompanyList');
Route::post('/admin-logout','AdminController@adminLogout');
Route::get('/all-email','AdminController@allEmailList');
Route::get('/send/mail','AdminController@mail');

Route::post('/admin-email-compose','AdminController@emailCompose');
Route::post('/admin-email-sent','AdminController@emailSent');


Route::get('admin-email','AdminController@emailList');
Route::get('/edit-company-info/{id}','AdminController@editCompanyInfo');
Route::post('/update-company-info/{id}','AdminController@updateCompanyInfo');
Route::get('/delete-company-info/{id}','AdminController@deleteCompanyInfo');
Route::post('/suspend-company-info','AdminController@suspendCompanyInfo');
Route::get('/all-trial-company-list','AdminController@allTrialCompanyList');
Route::get('/settings', 'AdminController@settings');
Route::post('/add-setting','AdminController@addSetting');
Route::get('/edit-setting/{id}','AdminController@editSetting');
Route::post('/update-setting/{id}','AdminController@updateSetting');
Route::get('/invoice', 'AdminController@invoice');
Route::get('/invoice-details/{id}', 'AdminController@invoiceDetails');
Route::post('/create-bill', 'AdminController@CreateBill');
Route::post('/show-bill', 'UserController@showBill');

Route::post('/compose-mail-trial-company','AdminController@composeMailTrialCompany');
Route::post('/send-mail-trial-company','AdminController@sendMailTrialCompany');

Route::get('/verify/{token}', 'UserController@verifyEmail');

Route::get('/payment-receive/{id}','AdminController@paymentReceive');
Route::post('/compare-hashtag','UserController@compareHashtag');
Route::get('/create-invoice/{id}/{id1}','AdminController@createInvoice');
Route::post('/update-user-extra-information','AdminController@editUserExtraInfo');

Route::get('/send-invoice-mail/{id}','AdminController@sendInvoiceMail');

Route::get('/user-create-invoice/{id}/{id1}','UserController@usercreateInvoice');




/* Admin Panel Route Start */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

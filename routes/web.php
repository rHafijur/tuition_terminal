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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::prefix('tutor')->group(function () {
    Route::view('/registration','tutor.registration')->name('tutor_registration');
    Route::post('/registration','TutorController@create')->name('create_tutor');
});
Route::middleware(['tutor'])->prefix('tutor')->group(function () {
    Route::get('/dashboard','TutorController@dashboard')->name('tutor_dashboard');
    Route::get('/view_info','TutorController@view_info')->name('tutor_view_info');
    Route::get('/payments','PaymentController@all')->name('tutor_payments');
    Route::get('/invoice/{id}','PaymentController@invoice')->name('tutor_invoice');
    Route::get('/verify_request','VerifiedTutorRequestController@create')->name('tutor_verify_request');
    Route::post('/verify_request','VerifiedTutorRequestController@create_payment')->name('post_tutor_verify_request');

    Route::post('/update_tutoring_info','TutorController@update_ti')->name('update_tutoring_info');
    Route::post('/update_educational_info','TutorController@update_ei')->name('update_educational_info');
    Route::post('/update_personal_info','TutorController@update_pi')->name('update_personal_info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

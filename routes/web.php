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

Route::get('/verify_email','Auth\VerificationController@verifyEmailPage')->name('verifyEmailPage');

Route::get('/otp','Auth\OtpVerificationController@index')->name('otp');
Route::post('/otp/verify','Auth\OtpVerificationController@verify')->name('otp.verify');
Route::post('/otp/resend','Auth\OtpVerificationController@resend')->name('otp.resend');
Route::get('/login/google','Auth\LoginController@google_login')->name('google_login');
Route::get('/login/google/callback','Auth\LoginController@google_login_callback')->name('google_login_callback');

Route::prefix('tutor')->group(function () {
    Route::get('/registration','TutorController@registration')->name('tutor_registration');
    Route::post('/registration','TutorController@create')->name('create_tutor');

    Route::post('/tutoring_info','TutorController@ti')->name('tutoring_info');
    Route::post('/educational_info','TutorController@ei')->name('educational_info');
    Route::post('/personal_info','TutorController@pi')->name('personal_info');
});
Route::middleware(['tutor'])->prefix('tutor')->group(function () {
    Route::get('/notification','NotificationController@tutorIndex')->name('tutor.notification');
    
    Route::get('/dashboard','TutorController@dashboard')->name('tutor_dashboard');
    Route::get('/view_info','TutorController@view_info')->name('tutor_view_info');

    Route::view('/tutor_upload_certificate','tutor.upload_certificate')->name('tutor_upload_certificate_form');
    Route::post('/tutor_upload_certificate','TutorController@upload_certificate')->name('tutor_upload_certificate');
    
    Route::get('/change_password','TutorController@change_password')->name('tutor_change_password');
    Route::post('/change_password','TutorController@update_password')->name('tutor_update_password');

    Route::get('/payments','PaymentController@all')->name('tutor_payments');
    Route::get('/invoice/{id}','PaymentController@invoice')->name('tutor_invoice');
    Route::get('/verify_request','VerifiedTutorRequestController@create')->name('tutor_verify_request');
    Route::post('/verify_request','VerifiedTutorRequestController@create_payment')->name('post_tutor_verify_request');

    Route::get('/featured_request','FeaturedTutorRequestController@create')->name('tutor_featured_request');
    Route::post('/featured_request','FeaturedTutorRequestController@create_payment')->name('post_tutor_featured_request');

    Route::get('/premium_request','PremiumMembershipRequestController@create')->name('tutor_premium_request');
    Route::post('/premium_request','PremiumMembershipRequestController@create_payment')->name('post_tutor_premium_request');

    Route::post('/update_tutoring_info','TutorController@update_ti')->name('update_tutoring_info');
    Route::post('/update_educational_info','TutorController@update_ei')->name('update_educational_info');
    Route::post('/update_personal_info','TutorController@update_pi')->name('update_personal_info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('/dashboard','TutorController@dashboard')->name('tutor_dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

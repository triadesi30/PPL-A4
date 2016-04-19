<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('/','HomeController@index');
  Route::get('/adoption','HomeController@adoption');
  Route::get('/shelter','HomeController@shelter');
  Route::post('/adoption','HomeController@searchAdoption');
  Route::get('/about','HomeController@about');
  Route::get('/faq','HomeController@faq');
  Route::get('/news','HomeController@news');
  Route::get('/news/{id}','HomeController@singleNews');
  Route::get('/login','UserController@loginForm');
  Route::get('/register','UserController@registerForm');
  Route::post('/login','UserController@login');
  Route::get('/contact','HomeController@contact');
  Route::post('/contact','HomeController@contactPost');
  Route::post('/register','UserController@register');
  Route::get('/register/google','UserController@google');
  Route::get('/register/facebook','UserController@facebook');
  Route::get('/register/gCallBack','UserController@googleCallBack');
  Route::get('/register/fCallBack','UserController@facebookCallBack');  
  Route::get('/logout','UserController@logout');
  Route::get('/admin','AdminController@index');
  Route::get('/admin/news/new','AdminController@newNews');
  Route::post('/admin/news/new','AdminController@saveNews');
});
Route::get('/viewProfile','UserController@viewProfile')->middleware(['web','usermid']);
Route::get('/profile','UserController@showProfile')->middleware(['web','usermid']);
Route::post('/profile','UserController@editProfile')->middleware(['web','usermid']);
Route::get('/list','UserController@listAdoptions')->middleware(['web','usermid']);
Route::get('/adoption/create','UserController@createAdoption')->middleware(['web','usermid']);
Route::post('/adoption/create','UserController@saveAdoption')->middleware(['web','usermid']);
Route::get('/adoption/mark/{id}','UserController@markDone')->middleware(['web','usermid']);

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

Route::get('/', function () {
    return view('public.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
  Route::get ('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\Admin\LoginController@login');
  Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
  Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
  Route::post('/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get ('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset');
  Route::get ('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
});

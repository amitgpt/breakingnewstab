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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('test', 'TestController@test');
Route::get('/youtuberssseed', 'TestController@youtubeRssSeed');

Route::get('/', 'HomeController@index');
Route::get('/covid-19', 'HomeController@covid');
Route::get('/managesources/{channel}', 'HomeController@managesources');
Route::post('loadmoredata', 'HomeController@loadmoredata');
Route::get('ajaxRequest', 'YouTubeNewsController@index');
Route::post('ajaxRequest', 'YouTubeNewsController@ajaxRequestPost');
Route::get('/news', 'ExtensionsController@index');
Route::get('/news/loadmoredata', 'ExtensionsController@loadmoredata');
Route::get('/news/loadalldata', 'ExtensionsController@loadalldata');
Route::get('/news/loadallcatdata', 'ExtensionsController@loadallcatdata');




//Auth::routes();

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){

    // Authentication Routes...  
    Route::get('login', 'AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'AdminLoginController@login');
    Route::post('logout', 'AdminLoginController@logout')->name('logout');

    // Password Reset Routes...
    //Route::get('password/reset', ['as'=>'passwordreset','uses'=>'AdminLoginController@showPasswordResetForm']);
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset');
    Route::post('password/update', 'ResetPasswordController@update');
   
});

// Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
    Route::get('/admin/dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard')->middleware('auth');
    Route::get('/admin/change-password', 'Admin\ChangePasswordController@index');
    Route::post('/admin/change-password', 'Admin\ChangePasswordController@store')->name('change.password');
    Route::get('/admin/rssfeeds', 'Admin\RssFeedsController@index')->name('admin.rssfeeds');
    Route::get('/admin/rssfeeds/ajax-pagination', 'Admin\RssFeedsController@index')->name('ajax.pagination');
    Route::get('/admin/changeRssFeedStatus', 'Admin\RssFeedsController@changeStatus');
    Route::get('/admin/rssfeeds/create','Admin\RssFeedsController@create');
    Route::post('/admin/rssfeeds/store','Admin\RssFeedsController@store');
    Route::delete('/admin/rssfeeds/delete/{id}','Admin\RssFeedsController@destroy');
    Route::get('/admin/rssfeeds/edit/{id}','Admin\RssFeedsController@edit');
    Route::post('/admin/rssfeeds/update/{id}','Admin\RssFeedsController@update');
//});




Auth::routes();

//Route::get('/home', 'Admin\DashboardController@dashboard')->name('admin.dashboard')->middleware('is_admin');

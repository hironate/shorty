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


/* Optional endpoints */
if (env('SHORTY_ALLOW_ACCT_CREATION')) {
    Route::get('/signup', ['as' => 'signup', 'uses' => 'UserController@displaySignupPage']);
    Route::post('/signup', ['as' => 'psignup', 'uses' => 'UserController@performSignup']);
}

Route::get('/', ['as' => 'index', 'uses' => 'IndexController@showIndexPage']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'UserController@performLogoutUser']);
Route::get('/login', ['as' => 'login', 'uses' => 'UserController@displayLoginPage']);
Route::get('/about', ['as' => 'about', 'uses' => 'StaticPageController@displayAbout']);

Route::get('/lost_password', ['as' => 'lost_password', 'uses' => 'UserController@displayLostPasswordPage']);
Route::get('/activate/{username}/{recovery_key}', ['as' => 'activate', 'uses' => 'UserController@performActivation']);
Route::get('/reset_password/{username}/{recovery_key}', ['as' => 'reset_password', 'uses' => 'UserController@performPasswordReset']);

Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@displayAdminPage']);

Route::get('/setup', ['as' => 'setup', 'uses' => 'SetupController@displaySetupPage']);
Route::post('/setup', ['as' => 'psetup', 'uses' => 'SetupController@performSetup']);
Route::get('/setup/finish', ['as' => 'setup_finish', 'uses' => 'SetupController@finishSetup']);

Route::get('/{short_url}', ['uses' => 'LinkController@performRedirect']);
Route::get('/{short_url}/{secret_key}', ['uses' => 'LinkController@performRedirect']);

Route::get('/admin/stats/{short_url}', ['uses' => 'StatsController@displayStats']);

/* POST endpoints */

Route::post('/login', ['as' => 'plogin', 'uses' => 'UserController@performLogin']);
Route::post('/shorten', ['as' => 'pshorten', 'uses' => 'LinkController@performShorten']);
Route::post('/lost_password', ['as' => 'plost_password', 'uses' => 'UserController@performSendPasswordResetCode']);
Route::post('/reset_password/{username}/{recovery_key}', ['as' => 'preset_password', 'uses' => 'UserController@performPasswordReset']);

Route::post('/admin/action/change_password', ['as' => 'change_password', 'uses' => 'AdminController@changePassword']);




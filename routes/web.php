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
use Illuminate\Http\Request;
Use \App\User;

// Social Auth
Route::get('auth/social', 'Auth\SocialAuthController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');


Auth::routes();

Route::get('/', function () {
$links = \App\Link::all();
return view('welcome', ['links' => $links]);
})->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/link','LinkController@create');
Route::post('/link','LinkController@store');

Route::get('/link/{link}','LinkController@edit');
Route::post('/link/{link}','LinkController@update');

Route::delete('/link/{link}', 'LinkController@destroy')->name('links.destroy');

Route::get('/links', 'LinkController@index');

Route::resource('users', 'UserController');

Route::prefix('api')->group(function() {
    Route::resource('comments', 'CommentController');
});

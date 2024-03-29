<?php
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::group(['prefix' => 'posts', 'namespace' => 'Posts'], function () {
    Route::get('/', 'IndexController@index')->name('posts.index');

    Route::get('/create', 'CreateController@create')->name('posts.create');
    Route::post('/create', 'CreateController@store')->name('posts.create.store');

    Route::post('/{slug}/reviews', 'ReviewController@show')->name('posts.post.review.show');

    Route::post('/{slug}/category', 'CategoryController@show')->name('posts.post.category.show');

    Route::get('/{slug}/vote', 'VoteController@update')->name('posts.post.vote.update');

    Route::get('/{slug}/edit', 'EditController@edit')->name('posts.post.edit');
    Route::post('/{slug}/edit', 'EditController@update')->name('posts.post.edit.update');
    Route::get('/{slug}', 'PostController@show')->name('posts.post.show');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('/sign-up', 'SignUpController@create')->name('auth.sign-up');
    Route::post('/sign-up', 'SignUpController@store')->name('auth.sign-up.store');

    Route::get('/sign-in', 'SignInController@create')->name('auth.sign-in');
    Route::post('/sign-in', 'SignInController@auth')->name('auth.sign-in.auth');

    Route::get('/sign-out', 'SignOutController@signOut')->name('auth.sign-out.auth');
});

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {

    Route::group(['prefix' => 'auth', 'namespcae' => 'Auth'], function () {
        Route::post('/', 'AdminController@dashboard')->name('dashbord.auth.index');
        Route::get('/sign-in', 'SignInController@create')->name('dashbord.auth.create');
        Route::post('/sign-in', 'SignInController@auth')->name('dashbord.auth.sign-in.store');

        Route::get('/sign-out', 'SignOutController@signOut')->name('dashbord.auth.sign-out');
    });
});

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/{slug}', 'UserController@show')->name('users.user.show');
});

Route::group(['prefix' => 'account', 'namespace' => 'Account'], function () {
    Route::get('/{slug}', 'EditController@show')->name('accounts.account.show');

    Route::get('/{slug}/edit', 'EditController@edit')->name('accounts.account.edit');
    Route::post('/{slug}/edit', 'EditController@update')->name('accounts.account.edit.update');
});

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

use App\Video;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Rutas del controlador Videos

Route::get('/subir-video', array(
    'as'=>'createVideo',
    'middleware'=>'auth',
    'uses'=>'VideoController@createVideo'
));
Route::get('/Video/Detail/{id}', 'VideoController@getVideoDetail')->name('detail.video');
Route::get('/Image/{filename}', 'VideoController@getImage')->name('view.image');
Route::get('/Video/{filename}', 'VideoController@getVideo')->name('view.video');
Route::post('/Video/Save', 'VideoController@saveVideo')->name('save.video');
Route::get('/Video/Delete/{id}', 'VideoController@delete')->name('delete.video');
Route::get('/Video/Edit/{id}', 'VideoController@edit')->name('edit.video');
Route::post('/Video/Update/{id}', 'VideoController@update')->name('update.video');
Route::get('/Video/Search/{search?}', 'VideoController@search')->name('search.video');




// Comments

Route::post('/Comment/Save', 'CommentController@save')->name('save.comment');
Route::get('/Comment/Delete/{id}', 'CommentController@delete')->name('delete.comment');


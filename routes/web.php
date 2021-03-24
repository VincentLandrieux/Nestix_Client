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

Route::get('/', function(){
    $mediaController = new App\Http\Controllers\MediaController();
    $mediasNews = $mediaController->indexNews(4);
    $mediasScores = $mediaController->indexScores(4);

    return view('accueil', compact('mediasNews', 'mediasScores'));
})->name('accueil');


Route::get('media/{media_id}', [
    'as' => 'media',
    'uses' => 'MediaController@show'
])->where('media_id', '[0-9]+');
Route::get('media/{media_id}/note/{note}', [
    'as' => 'media.note',
    'uses' => 'MediaController@updateNote'
])->where('media_id', '[0-9]+')->where('note', '[1-5]');

Route::get('{media_type}', [
    'as' => 'medias',
    'uses' => 'MediaController@index'
])->where('media_type', 'livres|films|musiques');

Route::get('medias/genre/{genre_id}', [
    'as' => 'medias.genre',
    'uses' => 'MediaController@indexByGenre'
])->where('genre_id', '[0-9]+');


Route::get('artiste/{artiste_id}', [
    'as' => 'artiste',
    'uses' => 'ArtisteController@show'
])->where('artiste_id', '[0-9]+');

Route::post('search', 'OtherController@search')->name('search');

Route::post('collection', 'OtherController@createCollection')->name('collection.create')->middleware('auth');
Route::put('collection/{collection_id}', 'OtherController@updateCollection')->name('collection.update')
->where('collection_id', '[0-9]+')->middleware('auth');
Route::delete('collection/{collection_id}', 'OtherController@deleteCollection')->name('collection.delete')
->where('collection_id', '[0-9]+')->middleware('auth');
Route::post('collection/{collection_id}/media/{media_id}', 'OtherController@createMediaCollection')->name('collection.media.create')
->where('collection_id', '[0-9]+')->where('media_id', '[0-9]+')->middleware('auth');
Route::delete('collection/{collection_id}/media/{media_id}', 'OtherController@deleteMediaCollection')->name('collection.media.delete')
->where('collection_id', '[0-9]+')->where('media_id', '[0-9]+')->middleware('auth');

Route::get('proposition', 'OtherController@proposition')->name('proposition')->middleware('auth');
Route::post('proposition', 'OtherController@createProposition')->name('proposition')->middleware('auth');

Route::get('profil', 'CompteController@edit')->name('profil');
Route::put('profil', 'CompteController@update')->name('profil.update');
Route::put('password', 'CompteController@updatePassword')->name('password.update');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

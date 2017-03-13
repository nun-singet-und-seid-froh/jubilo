<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return view('start');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

/*
 *      ABOUT
 */

Route::get('/about', function() { return view('about'); });

/*
 *      AUTHENTICATED ROUTES
 *
 */

Route::group(['middleware' => 'auth'], function () {
    
    // EDITORIAL BOARD
    Route::get('/board', 'BoardController@index')->name('indexBoard');

    // PUBLISH
    Route::get('/piece/publish', 'PieceController@publish')->name('addPiece');
    Route::post('/piece/store', 'PieceController@store')->name('storePiece');
    Route::get('/piece/published/{id}', 'PieceController@publishSucces')->name('publishedPiece');

    Route::post('/image/prepare', 'ImageController@prepare')->name('prepareImage');

    });


    Route::get('/logout', function() { 
        Auth::logout(); 
        return view ('start');
        });

/*
 *      CATALOGUE
*/

Route::get('/catalogue', 'CatalogueController@show')->name('showCatalogue');
Route::post('catalogue-filter', 'CatalogueController@filter')->name('filterCatalogue');

/*
 *  SHOW PIECE
*/

Route::get('/piece/show/{id}', 'PieceController@show')->name('showPiece');

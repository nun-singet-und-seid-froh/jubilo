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


Route::get('/permission', function() { return view('errors.permissions'); });
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
    Route::get('/board', 'BoardController@index')->name('indexBoard')->middleware('unconfirmed');

    // PUBLISH
    Route::get('/piece/publish', 'PieceController@publish')->name('addPiece')->middleware('unconfirmed');
    
    Route::post('/piece/store', 'PieceController@store')->name('storePiece')->middleware('unconfirmed');
    Route::get('/piece/published/{id}', 'PieceController@publishSucces')->name('publishedPiece')->middleware('unconfirmed');
  
    Route::post('image/raw', 'ImageController@uploadRaw')->name('uploadRawImage')->middleware('unconfirmed');
    Route::post('image/store', 'CropController@store')->name('storeImage')->middleware('unconfirmed');
});

    Route::get('admin/users', 'AdminController@showUsers')->name('showUsers')->middleware('admin');

    Route::post('admin/updateusers', 'AdminController@updateUsers')->name('updateUsers')->middleware('admin');
    
    Route::get('board/epoques', 'EpoquesController@index')->name('indexEpoques')->middleware('unconfirmed');
    
    Route::post ('board/epoques/update', 'EpoquesController@update')->name('updateEpoques')->middleware('unconfirmed');
    
    Route::get('/logout', function() { 
        Auth::logout(); 
        return view ('start');
        });

/*
 *      CATALOGUE
*/

Route::get('/catalogue', 'CatalogueController@show')->name('showCatalogue');
Route::post('catalogue-filter', 'CatalogueController@filter')->name('filterCatalogue');
Route::get('/catalogue/help', function() { return view('catalogue.help'); } );

/*
 *  SHOW PIECE
*/

Route::get('/piece/show/{id}', 'PieceController@show')->name('showPiece');

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
    Route::get('/board', 'BoardController@index')->name('indexBoard')->middleware('board');

    // PUBLISH
    Route::get('/piece/publish', 'PieceController@publish')->name('addPiece')->middleware('board');
    
    Route::post('/piece/store', 'PieceController@store')->name('storePiece')->middleware('board');
    Route::get('/piece/published/{id}', 'PieceController@publishSucces')->name('publishedPiece')->middleware('board');
  
    Route::post('image/raw', 'ImageController@uploadRaw')->name('uploadRawImage')->middleware('board');
    Route::post('image/store', 'CropController@store')->name('storeImage')->middleware('board');

    Route::get('admin/users', 'AdminController@showUsers')->name('showUsers')->middleware('admin');

    Route::post('admin/updateusers', 'AdminController@updateUsers')->name('updateUsers')->middleware('admin');
    
    Route::get('board/epoques', 'EpoqueController@index')->name('indexEpoques')->middleware('board');
    Route::post ('board/epoques/update', 'EpoqueController@update')->name('updateEpoques')->middleware('board');
    
    Route::get('/board/create/source', 'SourceController@create')->name('createSource')->middleware('board');
    Route::post('/board/store/source', 'SourceController@store')->name('storeSource')->middleware('board');
    Route::get('/board/created/source/', 'SourceController@created')->name('createdSource')->middleware('board');
    Route::get('board/list/source', 'SourceController@index')->name('listSource')->middleware('board');

	Route::get('/board/erratums/', 'ErratumController@index')->name('listErratum')->middleware('board');

	Route::post('/board/update/erratum/', 'ErratumController@update')->name('update')->middleware('board');


    Route::get('/logout', function() { 
        Auth::logout(); 
        return view ('start');
        });
    });


/*
 *      CATALOGUE
*/

Route::get('/catalogue', 'CatalogueController@show')->name('showCatalogue');
Route::post('/catalogue-filter', 'CatalogueController@filter')->name('filterCatalogue');
Route::get('/catalogue/help', function() { return view('catalogue.help'); } );

/*
 *  SHOW PIECE
*/

Route::get('/piece/show/{id}', 'PieceController@show')->name('showPiece');

Route::get('/erratum/create/{piece_id}', 'ErratumController@create')->name('createErratum');

Route::post('/erratum/store', 'ErratumController@store')->name('storeErratum');



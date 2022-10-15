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
    return view('index');
})->name('home');

Route::get('/mock-data', function () {
    return view('components.mockdata');
})->name('mock-data');

Route::prefix('image')->namespace('Image')->group(function () {
    Route::get('/', 'ImageController@index')->name('image');
    Route::get('/builder', 'ImageController@builder')->name('image-builder');
    Route::get('/compress', 'ImageController@compress')->name('image-compress');
    Route::get('/resize', 'ImageController@resize')->name('image-resize');
    Route::get('/crop', 'ImageController@crop')->name('image-crop');

    Route::prefix('/rotate')->group(function () {
        Route::get('/', 'RotateImageController@index')->name('image-rotate');
        Route::post('/rotate-download', 'RotateImageController@download')->name('rotate-download');
    });


    Route::get('/download/{fileName}', 'ImageController@download')->name('image-download');
    Route::post('/generate', 'ImageController@generate')->name('image-generate');
    Route::post('/preview', 'ImageController@preview')->name('image-preview');
    Route::post('/upload', 'UploadMediaController@uploadImage')->name('upload-image');
});

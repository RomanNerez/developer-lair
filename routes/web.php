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

Route::prefix('html-banner')->namespace('HtmlBanner')->group(function () {
    Route::get('/', 'HtmlBannerController@index')->name('html-banner');
});

Route::prefix('image')->namespace('Image')->group(function () {
    Route::get('/', 'ImageController@index')->name('image');
    Route::get('/builder', 'ImageController@builder')->name('image-builder');
    Route::get('/generate-meme', 'ImageController@generateMeme')->name('generate-meme');
    Route::get('/compress', 'ImageController@compress')->name('image-compress');
    Route::get('/resize', 'ImageController@resize')->name('image-resize');
    Route::post('/resize/resizing', 'ImageController@resizing')->name('image-resizing');

    Route::prefix('/crop')->group(function () {
        Route::get('/', 'CropImageController@index')->name('image-crop');
        Route::post('/cropping', 'CropImageController@cropping')->name('image-cropping');
    });

    Route::prefix('/rotate')->group(function () {
        Route::get('/', 'RotateImageController@index')->name('image-rotate');
        Route::post('/rotate-download', 'RotateImageController@download')->name('rotate-download');
    });


    Route::get('/share/{uuid}', 'ImageController@share')->name('image-share');

    Route::get('/download/{fileName}', 'ImageController@download')->name('image-download');
    Route::post('/generate', 'ImageController@generate')->name('image-generate');
    Route::post('/preview', 'ImageController@preview')->name('image-preview');
    Route::post('/upload', 'UploadMediaController@uploadImage')->name('upload-image');
});

Auth::routes();

Route::prefix('admin')
    ->middleware('auth')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin-index');
        Route::get('/media', 'MediaController@index')->name('admin-media');
    });

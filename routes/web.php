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
})->name('index');

Route::get('/kriteria', 'KriteriaController@index')->name('kriteria.index');

Route::get('/alternatif', 'AlternatifController@index')->name('alternatif.index');
Route::post('/alternatif', 'AlternatifController@store')->name('alternatif.store');
Route::post('/alternatif/{alternatif}/delete', 'AlternatifController@destroy')->name('alternatif.delete');
Route::post('/alternatif/update', 'AlternatifController@update')->name('alternatif.update');

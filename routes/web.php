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
Route::post('/kriteria', 'KriteriaController@store')->name('kriteria.store');
Route::post('/kriteria/{kriteria}/delete', 'KriteriaController@destroy')->name('kriteria.delete');
Route::post('/kriteria/update', 'KriteriaController@update')->name('kriteria.update');

Route::get('/alternatif', 'AlternatifController@index')->name('alternatif.index');
Route::post('/alternatif', 'AlternatifController@store')->name('alternatif.store');
Route::post('/alternatif/{alternatif}/delete', 'AlternatifController@destroy')->name('alternatif.delete');
Route::post('/alternatif/update', 'AlternatifController@update')->name('alternatif.update');

Route::get('/perbandinganKriteria', 'PerbandinganKriteriaController@index')->name('perbandinganKriteria.index');
Route::post('/perbandinganKriteria', 'PerbandinganKriteriaController@update')->name('perbandinganKriteria.update');
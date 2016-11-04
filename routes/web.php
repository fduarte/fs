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

//Route::get('/', function () {
//    return view('person.index');
//});

Route::get('/', 'PersonController@index')->name('person.index');
Route::post('person/store', 'PersonController@store')->name('person.store');
Route::get('person/read/{id}', 'PersonController@read')->name('person.read');
Route::get('person/update/{id}', 'PersonController@update')->name('person.update');
Route::get('person/delete/{id}', 'PersonController@delete')->name('person.delete');

Route::get('person/create', function() {
    return view('person.create');
})->name('person.create');

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


Route::get('/', 'PersonController@index')->name('person.index');
Route::get('person/create', function() {
    return view('person.create');
})->name('person.create');
Route::post('person/store-new', 'PersonController@storeNew')->name('person.store.new');
Route::post('person/store-existing/{id}', 'PersonController@storeExisting')->name('person.store.existing');
Route::get('person/read/{id}', 'PersonController@read')->name('person.read');
Route::get('person/update/{id}', 'PersonController@update')->name('person.update');
Route::get('person/delete/{id}', 'PersonController@delete')->name('person.delete');

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
});


Auth::routes();

Route::get('/home', 'RansomWareController@index')->name('home');


Route::get('/ransomware', 'RansomWareController@ransomWare');


Route::get('/markpaid/{id}', 'RansomWareController@paid')->name('markPaid');

Route::get('/mark-unpaid/{id}', 'RansomWareController@notPaid')->name('notPaid');


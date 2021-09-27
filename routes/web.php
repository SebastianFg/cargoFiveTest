<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::apiResource('/contracts','ContractController');
Route::get('/rates/{contract_id}','RateController@getRateByContract');

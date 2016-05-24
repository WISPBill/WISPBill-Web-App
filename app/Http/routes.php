<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (Auth::check())
    {
    return view('home');
    }
    else
    {
    return view('auth/login');
    }
});

Route::get('/maplead', 'leadcontroller@map');

Route::get('/newlead', 'leadcontroller@create');
Route::post('/newlead', 'leadcontroller@store');

Route::get('/addleadlocation', 'leadcontroller@addlocation');
Route::post('/addleadlocation', 'leadcontroller@storeaddlocation');

Route::get('/viewlead', 'leadcontroller@index');
Route::get('/viewalead/{id}', 'leadcontroller@show');

Route::get('/settings', 'settingscontroller@main');
Route::post('/setstripekey', 'settingscontroller@setstripekey');
Route::post('/setgeocoder', 'settingscontroller@setgeocoder');
Route::post('/setmapview', 'settingscontroller@setmapview');
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
    return view('welcome');
});

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//app specific routes

Route::group(['middleware' => 'auth'], function () {
//Users
Route::get('users', array('uses' => 'UserController@showActiveUsers', 'as' => 'users'));
Route::get('users/details', array('uses' => 'UserController@userDetails', 'as' => 'userDetails'));
Route::post('users/update', array('uses' => 'UserController@updateUserDetails', 'as' => 'userUpdate'));
Route::get('users/new', array('uses' => 'UserController@newUser', 'as' => 'userNew'));
Route::post('users/add', array('uses' => 'UserController@addUser', 'as' => 'userAdd'));
//Devices
Route::post('device/update', 'DeviceController@updateDevice')->name('deviceUpdate');
Route::post('device/new', 'DeviceController@newDevice')->name('deviceNew');
//Equipment
Route::get('equipment', array('uses'=>'EquipmentController@showEquipment', 'as'=>'equipment'));
Route::post('equipment/add', array('uses'=>'EquipmentController@updateEquipment', 'as'=>'updateEquipment'));
//Towers
Route::get('towers', 'TowerController@showTowers')->name('towers');
Route::post('towers/add', 'TowerController@updateTowers')->name('updateTower');
//Networks
Route::get('networks', 'NetworkController@showNetworks')->name('networks');
Route::post('networks/update', 'NetworkController@updateNetworks')->name('updateNetwork');
Route::post('networks/add', 'NetworkController@addNetworks')->name('addNetwork');
});

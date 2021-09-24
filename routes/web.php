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

Route::group(['middleware' => ['custom_auth']], function(){
    Route::post('/logout', 'AuthController@logout');
    Route::get('/', 'ServicenowController@index');

    // Route::group(['prefix' => '/auth'], function($auth){
    //     $auth->get('/', function(){
    //        return view('test');
    //     });

    //     $auth->group(['prefix' => '/update'], function($update){
    //         $update->post('navigation', 'AuthController@updateNavigation');
    //     });
    // });

    Route::resource('/risk', 'RiskManagementController');
});

Route::group(['middleware' => ['not_custom_auth']], function(){
//     Route::post('/login', 'AuthController@login');
    Route::get('/login', 'AuthController@index')->name('login');
});
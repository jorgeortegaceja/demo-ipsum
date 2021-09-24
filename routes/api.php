<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['prefix' => 'auth'], function($auth){
    $auth->post('/login', 'AuthController@login');
});

Route::group([], function($risk){
    $risk->get('/risks/{id}/{table}/{query}', 'RiskManagementController@show');
    $risk->resource('/risks', 'RiskManagementController');
});
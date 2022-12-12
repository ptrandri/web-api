<?php
/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/', function () {
    return "Halo Selamat datang di Student REST API!";
});

Route::post('api/login', 'AuthController@login');


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('api/logout', 'AuthController@logout');
    Route::post('api/refresh', 'AuthController@refresh');
    Route::get('api/profile', 'AuthController@get_profile');

    Route::get('api/students', 'StudentController@index'); 
    Route::get('api/student/{id}', 'StudentController@show'); 
    Route::post('api/student', 'StudentController@store'); 
    Route::patch('api/student', 'StudentController@update'); 
    Route::delete('api/student/{id}', 'StudentController@delete'); 

});




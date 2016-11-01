<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('admin/post_jobs', 'PostJobAPIController@index');
Route::post('admin/post_jobs', 'PostJobAPIController@store');
Route::get('admin/post_jobs/{post_jobs}', 'PostJobAPIController@show');
Route::put('admin/post_jobs/{post_jobs}', 'PostJobAPIController@update');
Route::patch('admin/post_jobs/{post_jobs}', 'PostJobAPIController@update');
Route::delete('admin/post_jobs{post_jobs}', 'PostJobAPIController@destroy');

Route::get('admin/categories', 'CategoryAPIController@index');
Route::post('admin/categories', 'CategoryAPIController@store');
Route::get('admin/categories/{categories}', 'CategoryAPIController@show');
Route::put('admin/categories/{categories}', 'CategoryAPIController@update');
Route::patch('admin/categories/{categories}', 'CategoryAPIController@update');
Route::delete('admin/categories{categories}', 'CategoryAPIController@destroy');
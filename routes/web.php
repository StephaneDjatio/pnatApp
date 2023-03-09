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
    return view('index');
});

Route::get('/getMenu', 'App\Http\Controllers\AnalyseController@getMenu');
Route::get('/analyze_data', 'App\Http\Controllers\AnalyseController@analyze_data');
Route::get('/getData', 'App\Http\Controllers\AnalyseController@getData');
Route::get('/getDatas', 'App\Http\Controllers\AnalyseController@getDatas');
Route::get('/getPolygonData', 'App\Http\Controllers\AnalyseController@getPolygonData');


Route::get('/login', 'App\Http\Controllers\Backend\LoginController@loginPage')->name('login');
Route::post('/authentification', 'App\Http\Controllers\Backend\LoginController@login')->name('authentification');

// Route::group(['middleware' => 'prevent-back-history'],function(){
// 	Auth::routes();

// });

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Backend\UserController@index')->name('admin.home');
    Route::get('admin/user/list', 'App\Http\Controllers\Backend\UserController@listUsers')->name('users.list');
    Route::get('admin/user/history', 'App\Http\Controllers\Backend\UserHistoryController@index');
    Route::get('admin/user/new', 'App\Http\Controllers\Backend\UserController@create');
    Route::post('admin/user/store', 'App\Http\Controllers\Backend\UserController@store')->name('users.store');
    Route::get('admin/user/show', 'App\Http\Controllers\Backend\UserController@show');
    Route::post('admin/user/update', 'App\Http\Controllers\Backend\UserController@update')->name('users.update');
    Route::post('admin/user/resetPassword', 'App\Http\Controllers\Backend\UserController@resetPassword')->name('users.resetPassword');
    Route::get('admin/user/logout', 'App\Http\Controllers\Backend\LoginController@perform_logout')->name('users.logout');


    Route::get('admin/data/index', 'App\Http\Controllers\Backend\DataUploadController@index')->name('data.list');
    Route::get('admin/data/add', 'App\Http\Controllers\Backend\DataUploadController@create');
    Route::post('admin/data/store', 'App\Http\Controllers\Backend\DataUploadController@store');
    Route::get('admin/data/show', 'App\Http\Controllers\Backend\DataUploadController@show');
    Route::post('admin/data/update', 'App\Http\Controllers\Backend\DataUploadController@update');
    Route::post('admin/data/upload-new-file', 'App\Http\Controllers\Backend\DataUploadController@uploadNewFile');
});

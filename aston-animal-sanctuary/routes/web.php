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
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserRequestsController;

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/services', [PagesController::class, 'services']);

Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::post('posts/create', 'PostsController@store');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('adopts', 'App\Http\Controllers\AdoptionController');

Route::post('adopts/approve/{id}', 'AdoptionController@adoptApprove');
Route::post('adopts/reject/{id}', 'AdoptionController@adoptReject');
Route::resource('animals', AnimalController::class);


Route::get('/requests/{id}', 'App\Http\Controllers\UserRequestsController@show')->name('requests');
Route::post('/requests/{id}', 'App\Http\Controllers\UserRequestsController@create')->name('requests');
Route::get('/requestsanimals', 'App\Http\Controllers\UserRequestsController@index')->name('requestsanimals');
Route::post('/requestsanimals', 'App\Http\Controllers\UserRequestsController@update')->name('requestsanimals');
Route::get('/requestsanimals/destroy/{id}', 'App\Http\Controllers\UserRequestsController@destroy')->name('destroyrequest');

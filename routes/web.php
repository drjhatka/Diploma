<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;

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
    return view('backend.syllabus-home');
});

Route::get('/backend/syllabus-manage', function(){
    return view('backend.syllabus-home');
})->name('syllabus.manage');

Route::post('/backend/syllabus/add','App\Http\Controllers\BackendController@syllabus_add')->name('syllabus.add');

Route::get('/backend/tutorial/add','App\Http\Controllers\BackendController@tutorial_add_home')->name('tutorial.add');
Route::post('/backend/tutorial/add','App\Http\Controllers\BackendController@tutorial_add_home')->name('tutorial.post');

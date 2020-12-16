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


//-------------------FRONTEND ROUTES----------------------//

//-------------------BACKEND ROUTES----------------------//
        //--dashboard--//
Route::get('/dashboard','BackendController@dashboard')->name('backend.dashboard');
Route::get('/dashboard/syllabus-add','BackendController@add_syllabus')->name('add.syllabus');
Route::get('/dashboard/add-tutorial', 'BackendController@add_tutorial')->name('add.tutorial');
Route::post('/dashboard/syllabus-post','BackendController@post_syllabus')->name('store.syllabus');
Route::post('/dashboard/tutorial-post','BackendController@post_tutorial')->name('store.tutorial');

//----------------json routes-----------------//
Route::get('/syllabus_modules','BackendController@get_syllabus_modules');
Route::get('/syllabus_module_topics/{subject}/{module}','BackendController@get_syllabus_module_topics');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
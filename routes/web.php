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

//----------------syllabus CRUD---------------------//
Route::get('/dashboard/syllabus-add','BackendController@add_syllabus')->name('add.syllabus');
Route::post('/dashboard/syllabus-post','BackendController@post_syllabus')->name('store.syllabus');

//----------------tutorial CRUD---------------------//
Route::get('/dashboard/add-tutorial', 'BackendController@add_tutorial')->name('add.tutorial');
Route::post('/dashboard/tutorial-post','BackendController@post_tutorial')->name('store.tutorial');

Route::get('/dashboard/manage-tutorial', 'BackendController@manage_tutorial')->name('manage.tutorial');
Route::get('/dashboard/view-tutorial/{id}', 'BackendController@view_tutorial')->name('view.tutorial');

Route::get('/dashboard/edit-tutorial/{id}', 'BackendController@edit_tutorial')->name('edit.tutorial');
Route::post('/dashboard/update-tutorial','BackendController@update_tutorial')->name('update.tutorial');

Route::get('/dashboard/delete-tutorial', 'BackendController@delete_tutorial')->name('delete.tutorial');




//----------------json routes-----------------//
Route::get('/syllabus_modules','BackendController@get_syllabus_modules');
Route::get('/syllabus_module_topics/{subject}/{module}','BackendController@get_syllabus_module_topics');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
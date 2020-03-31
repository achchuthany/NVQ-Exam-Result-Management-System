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
    return view('welcome');
});

Route::get('/departments/create', function () {
    return view('academic.department');
});

Route::get('/departments',[
    'uses' => 'DepartmentController@getDerpartments',
    'as' => 'departments'
]);

Route::post('/departments/create',[
    'uses' => 'DepartmentController@postCreateDepartment',
    'as' => 'departments.create'
]);

Route::post('/departments/edit',[
    'uses' => 'DepartmentController@postEditDepartment',
    'as' => 'departments.edit'
]);

Route::get('/departments/{d_id}/delete',[
    'uses'=>'DepartmentController@getDeleteDepartment',
    'as'=>'departments.delete'
]);

Route::get('/nvqs',[
    'uses' => 'NvqController@getNvqs',
    'as' => 'nvqs'
]);
Route::get('/nvqs/create',[
    'uses' => 'NvqController@getNvqsCreate',
    'as' => 'nvqs.create'
]);
Route::post('/nvqs/create',[
    'uses' => 'NvqController@postCreateNvq',
    'as' => 'nvqs.create'
]);
Route::post('/nvqs/edit',[
    'uses' => 'NvqController@postEditNvq',
    'as' => 'nvqs.edit'
]);
Route::get('/nvqs/{n_id}/delete',[
    'uses'=>'NvqController@getDeleteNvq',
    'as'=>'nvqs.delete'
]);

Route::get('/courses',[
    'uses' => 'CourseController@getCourses',
    'as' => 'courses'
]);
Route::get('/courses/create',[
    'uses' => 'CourseController@getCourseCreate',
    'as' => 'courses.create'
]);
Route::post('/courses/create',[
    'uses' => 'CourseController@postCourseCreate',
    'as' => 'courses.create'
]);
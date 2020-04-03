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

Route::get('/login',[
    'uses' => 'UserController@getLoginIndex',
    'as' => 'login'
]);

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
Route::post('/courses/edit',[
    'uses' => 'CourseController@postEditCourse',
    'as' => 'courses.edit'
]);
Route::get('/courses/{id}/delete',[
    'uses'=>'CourseController@getDeleteCourse',
    'as'=>'courses.delete'
]);

Route::get('/modules',[
    'uses' => 'ModuleController@getModules',
    'as' => 'modules'
]);
Route::get('/modules/create',[
    'uses' => 'ModuleController@getModuleCreate',
    'as' => 'modules.create'
]);
Route::post('/modules/create',[
    'uses' => 'ModuleController@postModuleCreate',
    'as' => 'modules.create'
]);

Route::get('/modules/{id}/delete',[
    'uses'=>'ModuleController@getDeleteModule',
    'as'=>'modules.delete'
]);

Route::get('/students',[
    'uses' => 'StudentController@getStudents',
    'as' => 'students'
]);
Route::get('/students/create',[
    'uses' => 'StudentController@getStudentCreate',
    'as' => 'students.create'
]);
Route::post('/students/create',[
    'uses' => 'StudentController@postCreateStudent',
    'as' => 'students.create'
]);

Route::get('/academics',[
    'uses' => 'AcademicYearController@getAcademicYears',
    'as' => 'academics'
]);
Route::get('/academics/create',[
    'uses' => 'AcademicYearController@getAcademicYearCreate',
    'as' => 'academics.create'
]);
Route::post('/academics/create',[
    'uses' => 'AcademicYearController@postCreateAcademicYear',
    'as' => 'academics.create'
]);
Route::post('/academics/edit',[
    'uses' => 'AcademicYearController@postEditAcademicYear',
    'as' => 'academics.edit'
]);
Route::get('/academics/{id}/delete',[
    'uses'=>'AcademicYearController@getDeleteAcademicYear',
    'as'=>'academics.delete'
]);

Route::get('/batches',[
    'uses' => 'BatchController@getBatches',
    'as' => 'batches'
]);
Route::get('/batches/create',[
    'uses' => 'BatchController@getBatchCreate',
    'as' => 'batches.create'
]);
Route::post('/batches/create',[
    'uses' => 'BatchController@postCreateBatch',
    'as' => 'batches.create'
]);
Route::post('/batches/edit',[
    'uses' => 'BatchController@postEditBatch',
    'as' => 'batches.edit'
]);
Route::get('/batches/{id}/delete',[
    'uses'=>'BatchController@getDeleteBatch',
    'as'=>'batches.delete'
]);
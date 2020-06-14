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
Route::get('/',[
    'uses' => 'IndexController@getIndex',
    'as' => 'index'
]);
Route::post('/result',[
    'uses' => 'IndexController@getIndexData',
    'as' => 'indexResult'
]);

Route::get('/login',[
    'uses' => 'UserController@getLoginIndex',
    'as' => 'login'
]);
Route::get('/changePassword',[
    'uses' => 'UserController@showChangePasswordForm',
    'as' => 'ChangePassword',
    'middleware' => 'roles',
    'roles' => ['Admin','Head','Lecturer','MA','Student']
]);
Route::post('/changePassword',[
    'uses' => 'UserController@changePassword',
    'as' => 'changePassword',
    'middleware' => 'roles',
    'roles' => ['Admin','Head','Lecturer','MA','Student']
]);
Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);
    //Department Data
    Route::get('/departments/create',[
        'uses' => 'DepartmentController@getDerpartmentCreate',
        'as' => 'department.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/departments',[
        'uses' => 'DepartmentController@getDerpartments',
        'as' => 'departments',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);

    Route::post('/departments/create',[
        'uses' => 'DepartmentController@postCreateDepartment',
        'as' => 'departments.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::post('/departments/edit',[
        'uses' => 'DepartmentController@postEditDepartment',
        'as' => 'departments.edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::get('/departments/{d_id}/delete',[
        'uses'=>'DepartmentController@getDeleteDepartment',
        'as'=>'departments.delete',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    //End Department Data

    //Start NVQ Data
    Route::get('/nvqs',[
        'uses' => 'NvqController@getNvqs',
        'as' => 'nvqs',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);
    Route::get('/nvqs/create',[
        'uses' => 'NvqController@getNvqsCreate',
        'as' => 'nvqs.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/nvqs/create',[
        'uses' => 'NvqController@postCreateNvq',
        'as' => 'nvqs.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/nvqs/edit',[
        'uses' => 'NvqController@postEditNvq',
        'as' => 'nvqs.edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/nvqs/{n_id}/delete',[
        'uses'=>'NvqController@getDeleteNvq',
        'as'=>'nvqs.delete',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    //End NVQ Data


    //Start Course Data
    Route::get('/courses',[
        'uses' => 'CourseController@getCourses',
        'as' => 'courses',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);
    Route::get('/courses/create',[
        'uses' => 'CourseController@getCourseCreate',
        'as' => 'courses.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/courses/create',[
        'uses' => 'CourseController@postCourseCreate',
        'as' => 'courses.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/courses/edit',[
        'uses' => 'CourseController@postEditCourse',
        'as' => 'courses.edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/courses/{id}/delete',[
        'uses'=>'CourseController@getDeleteCourse',
        'as'=>'courses.delete',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    //End Course Data

    //Start Module Data
    Route::get('/modules',[
        'uses' => 'ModuleController@getModules',
        'as' => 'modules',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);
    Route::get('/modules/course/{id}',[
        'uses' => 'ModuleController@getModulesbyCourse',
        'as' => 'modules.course',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);

    Route::get('/modules/create',[
        'uses' => 'ModuleController@getModuleCreate',
        'as' => 'modules.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/modules/create',[
        'uses' => 'ModuleController@postModuleCreate',
        'as' => 'modules.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::get('/modules/{id}/delete',[
        'uses'=>'ModuleController@getDeleteModule',
        'as'=>'modules.delete',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/modules/{id}/edit', [
        'uses' => 'ModuleController@getModuleEdit',
        'as' => 'modules.edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    //End Module Data

    //Students Start Data
    Route::get('/students',[
        'uses' => 'StudentController@getStudents',
        'as' => 'students',
        'middleware' => 'roles',
        'roles' =>['Admin']
    ]);
    Route::get('/students/batch/{id}',[
        'uses' => 'StudentController@getStudentsbyBatch',
        'as' => 'students.batch',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/students/course/{id}',[
        'uses' => 'StudentController@getStudentsbyCourse',
        'as' => 'students.course',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);
    Route::get('/students/academic/{id}',[
        'uses' => 'StudentController@getStudentsbyAcademicYear',
        'as' => 'students.academic',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::get('/students/create',[
        'uses' => 'StudentController@getStudentCreate',
        'as' => 'students.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/students/create',[
        'uses' => 'StudentController@postCreateStudent',
        'as' => 'students.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/students/{id}/delete',[
        'uses'=>'StudentController@getDeleteStudent',
        'as'=>'students.delete',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/students/{id}/edit', [
        'uses' => 'StudentController@getEditStudent',
        'as' => 'students.edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/students/{id}/enroll', [
        'uses' => 'StudentController@getEnrollIndex',
        'as' => 'students.enroll',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('/students/{id}/courses', [
        'uses' => 'StudentController@getCoursesIndex',
        'as' => 'students.courses',
        'middleware' => 'roles',
        'roles' =>['Admin','Head','Lecturer','MA']
    ]);
    Route::get('/students/{id}/attendance', [
        'uses' => 'StudentController@getCoursesIndex',
        'as' => 'students.attendance',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/students/enroll/create', [
        'uses' => 'StudentController@postStudentEnroll',
        'as' => 'students.enroll.create',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    //End Student Data

    Route::get('/academics',[
        'uses' => 'AcademicYearController@getAcademicYears',
        'as' => 'academics'
    ]);
    Route::get('/academic/create',[
        'uses' => 'AcademicYearController@getAcademicYearCreate',
        'as' => 'academics.create'
    ]);
    Route::post('/academic/create',[
        'uses' => 'AcademicYearController@postCreateAcademicYear',
        'as' => 'academics.create'
    ]);
    Route::get('/academic/{id}/edit',[
        'uses' => 'AcademicYearController@getEditAcademicYear',
        'as' => 'academics.edit'
    ]);
    Route::get('/academic/{id}/delete',[
        'uses'=>'AcademicYearController@getDeleteAcademicYear',
        'as'=>'academics.delete'
    ]);

    Route::get('/batches',[
        'uses' => 'BatchController@getBatches',
        'as' => 'batches'
    ]);
    Route::get('/batch/create',[
        'uses' => 'BatchController@getBatchCreate',
        'as' => 'batches.create'
    ]);
    Route::post('/batch/create',[
        'uses' => 'BatchController@postCreateBatch',
        'as' => 'batches.create'
    ]);
    Route::get('/batch/{id}/edit',[
        'uses' => 'BatchController@getEditBatch',
        'as' => 'batches.edit'
    ]);
    Route::get('/batch/{id}/delete',[
        'uses'=>'BatchController@getDeleteBatch',
        'as'=>'batches.delete'
    ]);

    Route::get('/employees',[
        'uses' => 'EmployeeController@getEmployees',
        'as' => 'employees'
    ]);

    Route::get('/employees/create',[
        'uses' => 'EmployeeController@getEmployeeCreate',
        'as' => 'employees.create'
    ]);
    Route::post('/employees/create',[
        'uses' => 'EmployeeController@postCreateEmployee',
        'as' => 'employees.create'
    ]);
    Route::post('/employees/search',[
        'uses' => 'EmployeeController@postSearchEmployee',
        'as' => 'employees.search'
    ]);

    Route::post('/tvec/exams/batch',[
        'uses' => 'TvecExamController@getTvecExamsByCourseBatch',
        'as' => 'tvec.exams.batch'
    ]);
    Route::get('/tvec/exams',[
        'uses' => 'TvecExamController@getTvecExams',
        'as' => 'tvec.exams'
    ]);
    Route::get('/tvec/exams/create',[
        'uses' => 'TvecExamController@getTvecExamCreate',
        'as' => 'tvec.exams.create'
    ]);
    Route::post('/tvec/exams/create',[
        'uses' => 'TvecExamController@postTvecExamCreate',
        'as' => 'tvec.exams.create'
    ]);
    Route::post('/tvec/exam/{id}/delete',[
        'uses'=>'TvecExamController@getDeleteTvecExam',
        'as'=>'tvec.exams.delete'
    ]);
    Route::get('/tvec/exam/{id}',[
        'uses' => 'TvecExamResultController@getLecturerTvecExamsResult',
        'as' => 'tvec.exams.results.view'
    ]);
    Route::get('/tvec/exam/{id}/results',[
        'uses' => 'TvecExamController@getTvecExamsResults',
        'as' => 'tvec.exams.results'
    ]);
    Route::post('/tvec/exam/results/create',[
        'uses' => 'TvecExamResultController@postTvecExamsResultsCreate',
        'as' => 'tvec.exams.results.create'
    ]);
    Route::get('/tvec/results',[
        'uses' => 'TvecExamResultController@getTvecResults',
        'as' => 'tvec.results'
    ]);
    Route::get('/tvec/result/batch/{id}',[
        'uses' => 'TvecExamResultController@getTvecExamsResultsbyBatch',
        'as' => 'tvec.exams.results.batch'
    ]);
    Route::post('/tvec/result/batch',[
        'uses' => 'TvecExamResultController@postTvecExamsResultsbyBatch',
        'as' => 'tvec.results.batch'
    ]);
    Route::get('/tvec/result/batch/{id}/pdf',[
        'uses' => 'TvecExamResultController@getTvecExamsResultsbyBatchPDF',
        'as' => 'tvec.exams.results.batch.pdf'
    ]);
    Route::get('/tvec/result/batch/{bid}/student/{id}',[
        'uses' => 'TvecExamResultController@getTvecExamsResultsbyStudentId',
        'as' => 'tvec.results.student'
    ]);

    Route::post('/ajax/course/modules',[
        'uses' => 'AjaxRequestController@postGetModulesbyCourse',
        'as' => 'ajax.modules'
    ]);
    Route::post('/ajax/batch/students',[
        'uses' => 'AjaxRequestController@postGetStudentsbyBatch',
        'as' => 'ajax.students.batch'
    ]);
    Route::post('/ajax/student/reg',[
        'uses' => 'AjaxRequestController@postGetStudentbyReg',
        'as' => 'ajax.students.reg'
    ]);
    Route::post('/ajax/course/batches',[
        'uses' => 'AjaxRequestController@postGetBatchesbyCourse',
        'as' => 'ajax.batches'
    ]);

    Route::get('/admin/users',[
        'uses' => 'UserController@getAllUsers',
        'as' => 'users',
        'middleware' => 'roles',
        'roles' => 'Admin'
    ]);
    Route::post('/admin/roles', [
        'uses' => 'UserController@postAssignRoles',
        'as' => 'user.roles',
        'middleware' => 'roles',
        'roles' => 'Admin'
    ]);
    Route::get('/admin/user', [
        'uses' => 'UserController@getUserIndex',
        'as' => 'user.index',
        'middleware' => 'roles',
        'roles' => 'Admin'
    ]);
    Route::post('/admin/user', [
        'uses' => 'UserController@postCreateUser',
        'as' => 'user.create',
        'middleware' => 'roles',
        'roles' => 'Admin'
    ]);

    Route::get('/employees/enroll',[
        'uses' => 'EmployeeModuleController@getEnrollIndex',
        'as' => 'employees.enroll'
    ]);
    Route::get('/employees/enroll/create',[
        'uses' => 'EmployeeModuleController@getEnrollCreateIndex',
        'as' => 'employees.enroll.create'
    ]);
    Route::get('/e/{id}',[
        'uses' => 'EmployeeModuleController@getProfileIndex',
        'as' => 'employee.profile'
    ]);
    Route::post('/employees/enroll/create',[
        'uses' => 'EmployeeModuleController@postEnrollCreate',
        'as' => 'employees.enroll.create'
    ]);
    Route::get('/employees/enroll/{id}/delete', [
        'uses' => 'EmployeeModuleController@getDeleteEnroll',
        'as' => 'employees.enroll.delete'
    ]);

    Route::get('/attendance/manage/{mid}/{aid}', [
        'uses' => 'AttendanceSessionController@getManageIndex',
        'as' => 'attendance.manage',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::get('/attendance/session/{mid}/{aid}', [
        'uses' => 'AttendanceSessionController@getSessionIndex',
        'as' => 'attendance.session',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::post('/attendance/session', [
        'uses' => 'AttendanceSessionController@postSessionCreate',
        'as' => 'attendance.session.create',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::post('/attendance/sessions/detete', [
        'uses' => 'AttendanceSessionController@postSessionsDelete',
        'as' => 'attendance.sessions.detete',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::post('/attendance/session/detete/{id}', [
        'uses' => 'AttendanceSessionController@postSessionDelete',
        'as' => 'attendance.session.detete',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);

    Route::get('/attendance/take/{id}', [
        'uses' => 'AttendanceController@getTakeIndex',
        'as' => 'attendance.take',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::post('/attendance/take', [
        'uses' => 'AttendanceController@getTakeCreate',
        'as' => 'attendance.take.create',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::get('/attendances', [
        'uses' => 'AttendanceController@getAttendancesIndex',
        'as' => 'attendances',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD']
    ]);
    Route::post('/attendances', [
        'uses' => 'AttendanceController@postAttendancesbyBatch',
        'as' => 'attendances.batch',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD']
    ]);
    Route::get('/attendance/report/{mid}/{aid}', [
        'uses' => 'AttendanceController@getReportIndex',
        'as' => 'attendance.report',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);
    Route::get('/attendance/view/{sid}/{mid}/{aid}', [
        'uses' => 'AttendanceController@getViewIndex',
        'as' => 'attendance.view',
        'middleware' => 'roles',
        'roles' => ['Admin','HOD','Lecturer']
    ]);

    //Student Route
    Route::get('/student/attendances', [
        'uses' => 'AttendanceController@getStudentAttendancesIndex',
        'as' => 'student.attendances',
        'middleware' => 'roles',
        'roles' => 'Student'
    ]);
    Route::get('/student/attendance/view/{sid}/{mid}/{aid}', [
        'uses' => 'AttendanceController@getStudentViewIndex',
        'as' => 'student.attendance.view',
        'middleware' => 'roles',
        'roles' => 'Student'
    ]);
    Route::get('/student/courses', [
        'uses' => 'StudentEnrollController@getStudentCoursesIndex',
        'as' => 'student.courses',
        'middleware' => 'roles',
        'roles' => 'Student'
    ]);
    Route::get('/student/tvecexams', [
        'uses' => 'TvecExamResultController@getStudentExamsIndex',
        'as' => 'student.tvecexams',
        'middleware' => 'roles',
        'roles' => 'Student'
    ]);
    Route::get('/student', [
        'uses' => 'StudentDashboardController@getIndex',
        'as' => 'student',
        'middleware' => 'roles',
        'roles' => 'Student'
    ]);
    Route::get('/student/profile', [
        'uses' => 'ProfileController@getStudentIndex',
        'as' => 'student.profile',
        'middleware' => 'roles',
        'roles' => 'Student'
    ]);
    //end student route


    //start lecturer route
    Route::get('/lecturer', [
        'uses' => 'LecturerDashboardController@getIndex',
        'as' => 'lecturer',
        'middleware' => 'roles',
        'roles' => 'Lecturer'
    ]);
    Route::get('/lecturer/modules', [
        'uses' => 'EmployeeModuleController@getEnrolledModules',
        'as' => 'lecturer.modules',
        'middleware' => 'roles',
        'roles' => 'Lecturer'
    ]);
    Route::get('/lecturer/attendances', [
        'uses' => 'AttendanceController@getLecturerAttendancesIndex',
        'as' => 'lecturer.attendances',
        'middleware' => 'roles',
        'roles' => 'Lecturer'
    ]);
    Route::get('/lecturer/profile', [
        'uses' => 'ProfileController@getLecturerIndex',
        'as' => 'lecturer.profile',
        'middleware' => 'roles',
        'roles' => 'Lecturer'
    ]);
    Route::get('/lecturer/tvec/exams', [
        'uses' => 'TvecExamController@getLecturerTvecExams',
        'as' => 'lecturer.tvec.exams',
        'middleware' => 'roles',
        'roles' => 'Lecturer'
    ]);
    Route::get('/lecturer/tvec/exams/{id}', [
        'uses' => 'TvecExamResultController@getLecturerTvecExamsResult',
        'as' => 'lecturer.tvec.exams.result',
        'middleware' => 'roles',
        'roles' => 'Lecturer'
    ]);
    //end lecturer route

});

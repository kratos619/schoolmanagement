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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'students' => 'StudentController'
]);
Route::get('studentall', 'StudentController@totalNumberStudnet');
Route::get('teachersall', 'TeachersController@totalNumberTeacher');
Route::get('departmentall', 'DepartmentController@totalNumberDepartment');
Route::get('coursesall', 'CoursesController@totalNumberCourses');

Route::apiResources([
    'teachers' => 'TeachersController'
]);
Route::apiResources([
    'courses' => 'CoursesController'
]);

Route::apiResources([
    'department' => 'DepartmentController'
]);

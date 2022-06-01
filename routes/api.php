<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/************Api users*************/
Route::post('login', 'API\UserController@login');
// Route::post('login', [UserController::class, 'login']);

/************Api student*************/
Route::post('loginStudent', 'API\StudentController@login');
Route::post('registerStudent', 'API\StudentController@register');
Route::post('logoutStudent', 'API\StudentController@logout');
Route::apiResource('courses', 'API\CourseController');
Route::middleware('auth:api')->group(function () { 
    Route::post('register', 'API\UserController@register');
    Route::post('send_code/{id}', 'API\UserController@send_code');
    Route::post('verify_code', 'API\StudentController@verify_code');
    Route::post('start_exam', 'API\StudentController@start_exam')->middleware('verify');;
    // Route::apiResource('courses', 'API\CourseController');
    Route::post('add/course/{id}', 'API\StudentController@add_course')->name('add.course');

    Route::apiResource('categories', 'API\CategoryController');
    
});



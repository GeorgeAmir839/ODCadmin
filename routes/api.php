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
Route::post('register', 'API\UserController@register');
/************Api student*************/
Route::post('loginStudent', 'API\StudentController@login');
Route::post('registerStudent', 'API\StudentController@register');
Route::post('logoutStudent', 'API\StudentController@logout');
Route::middleware('auth:api')->group(function () { 
    Route::apiResource('categories', 'API\CategoryController');
});

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*All*/
//Index
Route::get('/', function(){
	if(Auth::check()){
		return Redirect::to('dashboard');
	}else{
		return View::make('index');
	}
});
Route::resource('users', 'UsersController');
Route::post('login', 'UsersController@login');
Route::get('logout', 'UsersController@logout');
Route::get('users/reset', 'UsersController@showReset');
Route::post('users/reset', 'UsersController@processReset');
Route::get('users/reset/{id}', 'UsersController@completeReset');

/*Login*/
Route::group(array('before'=>'auth'), function(){
	Route::get('dashboard', 'UsersController@goToDashboard');
	Route::get('select', 'CoursesController@selectCourses');
	Route::get('select/{id}', 'CoursesController@selectChosenCourses');

	Route::resource('courses', 'CoursesController');
	Route::get('courses/enable/{id}','CoursesController@enableCourse');
	Route::get('courses/disable/{id}','CoursesController@disableCourse');

	Route::get('courses/{idc}/material/{idm?}', 'CoursesController@showMaterial');
	Route::get('courses/{idc}/material/{idm}/quiz/', 'CoursesController@showQuiz');
	Route::post('courses/{idc}/material/{idm}/showresult/', 'CoursesController@validateQuiz');
	Route::get('courses/{idc}/material/{idm}/nextmaterial/', 'CoursesController@nextMaterial');
	Route::get('courses/{idc}/result/', 'CoursesController@showResult');
	Route::get('courses/{idc}/result/printpdf', 'CoursesController@createPdf');

	Route::resource('materials', 'MaterialsController');

	Route::resource('classrooms', 'ClassroomsController');
	Route::get('classrooms/{id}/toggle', 'ClassroomsController@toggleStatus');

	Route::get('evaluation', 'UsersController@evaluation');
	Route::post('evaluation', 'UsersController@processEvaluation');

	Route::get('teacher', 'UsersController@teacherIndex');
	Route::get('teacher/allocation', 'UsersController@teacherCreate');
	Route::post('teacher/allocation', 'UsersController@teacherProcess');

	
});
/*Teacher Login*/



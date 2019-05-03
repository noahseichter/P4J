<?php

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
    return redirect('student');
});

// Authentication
Auth::routes();

// Change Password
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

// Student Resource
Route::resource('student', 'StudentController');

// User Resource
Route::resource('user', 'UserController');
Route::get('user/{user}/statistics/{domain}', 'UserController@statistics')->name('user.statistics');

// Create Student-User Relationships
Route::post('user/{user}/student', 'UserController@addStudent')->name('user.student.store');
Route::post('student/{student}/user', 'StudentController@addUser')->name('student.user.store');

// Remove Student-User Relationships
Route::delete('user/{user}/student/{student}', 'UserController@removeStudent')->name('user.student.destroy');
Route::delete('student/{student}/user/{user}', 'StudentController@removeUser')->name('student.user.destroy');

// Evaluation Editing
Route::get('student/{student}/domain/edit/{domain}', 'DomainController@edit')->name('student.domain.edit');

// Student "Teachers" Tab
Route::get('student/{student}/user', 'StudentController@showUsers')->name('student.user.show');

// Student "Domain" Tabs
Route::get('student/{student}/domain/{domain}', 'DomainController@index')->name('student.domain.index');

// Create Evaluation
Route::get('student/{student}/domain/{domain}/create/{semester}', 'DomainController@create')->name('student.domain.create');
Route::post('student/{student}/domain/{domain}', 'DomainController@store')->name('student.domain.store');

// Delete Evaluation
Route::delete('student/{student}/domain/{domain}', 'DomainController@destroy')->name('student.domain.destroy');


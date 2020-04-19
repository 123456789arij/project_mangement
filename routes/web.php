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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function () {
    Route::prefix('clients')->group(function () {
        Route::get('/', 'ClientController@index')->name('client.index');
        Route::get('/create', 'ClientController@create')->name('client.create');
        Route::post('/store', 'ClientController@store')->name('client.store');
        Route::get('/{id}', 'ClientController@show')->name('client.show');
        Route::get('/{id}/edit', 'ClientController@edit')->name('client.edit');
        Route::patch('/{id}', 'ClientController@update')->name('client.update');
        Route::delete('/{id}', 'ClientController@destroy')->name('client.destroy');
    });

    Route::prefix('projects')->group(function () {
        Route::get('/', 'ProjectController@index')->name('project');
        Route::get('/create', 'ProjectController@create')->name('project.create');
        Route::post('/store', 'ProjectController@store')->name('project.store');
        Route::get('/{project}', 'ProjectController@show')->name('project.show');
        Route::get('/{project}/edit', 'ProjectController@edit')->name('project.edit');
        Route::patch('/{project}', 'ProjectController@update')->name('project.update');
        Route::delete('/{id}', 'ProjectController@destroy')->name('project.destroy');
    });
    //task
    Route::prefix('tasks')->group(function () {
        Route::get('/', 'TaskController@index')->name('task');
        Route::get('/create', 'TaskController@create')->name('task.create');
        Route::post('/store', 'TaskController@store')->name('task.store');
        Route::get('/{task}', 'TaskController@show')->name('task.show');
        Route::get('/{task}/edit', 'TaskController@edit')->name('task.edit');
        Route::patch('/{task}', 'TaskController@update')->name('task.update');
        Route::delete('/{id}', 'TaskController@destroy')->name('task.destroy');
    });
    //department
    Route::prefix('departments')->group(function () {
        Route::get('/', 'DepartmentController@index')->name('department');
        Route::get('/create', 'DepartmentController@create')->name('department.create');
        Route::post('/store', 'DepartmentController@store')->name('department.store');
        Route::get('/{department}', 'DepartmentController@show')->name('department.show');
        Route::get('/{department}/edit', 'DepartmentController@edit')->name('department.edit');
        Route::patch('/{department}', 'DepartmentController@update')->name('department.update');
        Route::delete('/{id}', 'DepartmentController@destroy')->name('department.destroy');
    });
    //emplyoee
    Route::prefix('emplyoee')->group(function () {
        Route::get('/', 'EmplyoeeController@index')->name('emplyoee');
        Route::get('/create', 'EmplyoeeController@create')->name('emplyoee.create');
        Route::post('/store', 'EmplyoeeController@store')->name('emplyoee.store');
        Route::get('/{emplyoee}', 'EmplyoeeController@show')->name('emplyoee.show');
        Route::get('/{emplyoee}/edit', 'EmplyoeeController@edit')->name('emplyoee.edit');
        Route::patch('/{emplyoee}', 'EmplyoeeController@update')->name('emplyoee.update');
        Route::delete('/{id}', 'EmplyoeeController@destroy')->name('emplyoee.destroy');
    });
    //Category
    Route::get('category', 'entreprise\CategoryController@index')->name('category');
    Route::get('category/create', 'entreprise\CategoryController@create')->name('category.create');
    Route::post('category/store', 'entreprise\CategoryController@store')->name('category.store');
    Route::get('show/{category}', 'entreprise\CategoryController@show')->name('category.show');
    Route::get('category/{category}/edit', 'entreprise\CategoryController@edit')->name('category.edit');
    Route::patch('category/{category}', 'entreprise\CategoryController@update')->name('category.update');
    Route::delete('/categorydestroy/{id}', 'entreprise\CategoryController@destroy')->name('category.destroy');
});



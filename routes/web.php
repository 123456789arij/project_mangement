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
Route::prefix('Entreprise')->group(function () {
    Route::get('clients', 'Entreprise\ClientController@index')->name('client.index');
    Route::get('clients/create', 'Entreprise\ClientController@create')->name('client.create');
    Route::post('clients/store', 'Entreprise\ClientController@store')->name('client.store');
    Route::get('show/{client}', 'Entreprise\ClientController@show')->name('client.show');
    Route::get('client/{client}/edit', 'Entreprise\ClientController@edit')->name('client.edit');
    Route::patch('client/{client}', 'Entreprise\ClientController@update')->name('client.update');
    Route::delete('/clientdestroy/{id}', 'Entreprise\ClientController@destroy')->name('client.destroy');

    //Projet
    Route::get('projects', 'Entreprise\ProjectController@index')->name('project');
    Route::get('project/create', 'Entreprise\ProjectController@create')->name('project.create');
    Route::post('project/store', 'Entreprise\ProjectController@store')->name('project.store');
    Route::get('gg/{project}', 'Entreprise\ProjectController@show')->name('project.show');
    Route::get('project/{project}/edit', 'Entreprise\ProjectController@edit')->name('project.edit');
    Route::patch('project/{project}', 'Entreprise\ProjectController@update')->name('project.update');
    Route::delete('/projectdestroy/{id}', 'Entreprise\ProjectController@destroy')->name('project.destroy');

    //Category
    Route::get('category', 'Entreprise\CategoryController@index')->name('category');
    Route::get('category/create', 'Entreprise\CategoryController@create')->name('category.create');
    Route::post('category/store', 'Entreprise\CategoryController@store')->name('category.store');
    Route::get('show/{category}', 'Entreprise\CategoryController@show')->name('category.show');
    Route::get('category/{category}/edit', 'Entreprise\CategoryController@edit')->name('category.edit');
    Route::patch('category/{category}', 'Entreprise\CategoryController@update')->name('category.update');
    Route::delete('/categorydestroy/{id}', 'Entreprise\CategoryController@destroy')->name('category.destroy');

    //task
    Route::get('task', 'Entreprise\TaskController@index')->name('task');
    Route::get('task/create', 'Entreprise\TaskController@create')->name('task.create');
    Route::post('task/store', 'Entreprise\TaskController@store')->name('task.store');
    Route::get('show/{task}', 'Entreprise\TaskController@show')->name('task.show');
    Route::get('task/{task}/edit', 'Entreprise\TaskController@edit')->name('task.edit');
    Route::patch('task/{task}', 'Entreprise\TaskController@update')->name('task.update');
    Route::delete('/taskdestroy/{id}', 'Entreprise\TaskController@destroy')->name('task.destroy');

    //department
    Route::get('department', 'Entreprise\DepartmentController@index')->name('department');
    Route::get('department/create', 'Entreprise\DepartmentController@create')->name('department.create');
    Route::post('department/store', 'Entreprise\DepartmentController@store')->name('department.store');
    Route::get('show/{department}', 'Entreprise\DepartmentController@show')->name('department.show');
    Route::get('department/{department}/edit', 'Entreprise\DepartmentController@edit')->name('department.edit');
    Route::patch('department/{department}', 'Entreprise\DepartmentController@update')->name('department.update');
    Route::delete('/departmentdestroy/{id}', 'Entreprise\DepartmentController@destroy')->name('department.destroy');

});

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
Route::get('/data/{id}', 'GanttController@get');
//    project
Route::prefix('projects')->group(function () {
    Route::get('/', 'ProjectController@index')->name('project');
    Route::get('/create', 'ProjectController@create')->name('project.create');
    Route::post('/store', 'ProjectController@store')->name('project.store');
    Route::get('/{project}', 'ProjectController@show')->name('project.show');
    Route::get('/{id}/edit', 'ProjectController@edit')->name('project.edit');
    Route::patch('/{id}', 'ProjectController@update')->name('project.update');
    Route::delete('/{id}', 'ProjectController@destroy')->name('project.destroy');

    Route::get('/membre/{id}', 'ProjectController@afficher_membre_projet')->name('membre_projet');
    Route::post('/nouveau/membre/', 'ProjectController@membre_projet')->name('membre');
//        Route::delete('/{id}', 'ProjectController@destroy_membre')->name('destroy_membre');


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
    Route::get('/itemView', 'TaskController@itemView')->name('task.itemView');
    Route::post('/updateItem', 'TaskController@updateItems')->name('task.updateItems');

//        Route::get('/', array('as'=> 'front.home', 'uses' => 'ItemController@itemView'));
//        Route::post('/update-items', array('as'=> 'update.items', 'uses' => 'ItemController@updateItems'));
});

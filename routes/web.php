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
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//client AUthentification
Route::prefix('client')->group(function () {
    Route::get('/login', 'Auth\ClientController@showLoginForm')->name('client.login');
    Route::post('/login', 'Auth\ClientController@login')->name('client.login.submit');
    Route::post('logout/', 'Auth\ClientController@logout')->name('client.logout');
    Route::group(['middleware' => 'auth.client'], function () {
        Route::get('/dashborad', 'client\DashboradController@index')->name('client.dashborad');
        Route::get('/projects', 'client\ProjectController@index')->name('client.project');
        Route::get('/{project}', 'client\ProjectController@show')->name('client.project.show');
    });
});

//Employee AUthentification
Route::prefix('employee')->group(function () {
    Route::get('/login', 'Auth\EmployeeController@showLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeController@login')->name('employee.login.submit');
    Route::post('logout/', 'Auth\EmployeeController@logout')->name('employee.logout');
    Route::group(['middleware' => 'auth.employee'], function () {
        Route::get('/dashborad', 'employee\DashboradController@index')->name('employee.dashborad');
        Route::get('/projects', 'employee\ProjectController@index')->name('proj');
        Route::get('/tasks', 'employee\TaskController@index')->name('employee.task');
        Route::get('/{project}', 'employee\ProjectController@show')->name('employee.project.show');
        Route::get('/tasks/create', 'employee\TaskController@create')->name('task.create');
        Route::post('/tasks/store', 'employee\TaskController@store')->name('task.store');

        Route::get('/profile', 'employee\ProfileController@index')->name('profile');
        Route::get('/{id}/profile', 'employee\ProfileController@edit')->name('employee.profile.edit');
        Route::patch('/{id}', 'employee\ProfileController@update')->name('employee.profile.update');

        Route::get('/project/create', 'employee\ProjectController@create')->name('employee.project.create');
        Route::post('/project/store', 'employee\ProjectController@store')->name('employee.project.store');

        Route::get('/{id}/edit', 'employee\ProjectController@edit')->name('employee.project.edit');
        Route::patch('/{id}', 'employee\ProjectController@update')->name('employee.project.update');
        Route::delete('/{id}', 'employee\ProjectController@destroy')->name('employee.project.destroy');

        Route::get('/membre/{id}', 'employee\ProjectController@afficher_membre_projet')->name('employee.membre_projet');
        Route::post('/nouveau/membre/', 'employee\ProjectController@membre_projet')->name('employee.membre');

    });
});

Route::middleware('auth')->group(function () {

    Route::get('/gant', function () {
        return view('project.gantt');
    });

    Route::get('/laravel_google_chart', 'ChartController@index')->name('pieChart');
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
    Route::prefix('clients')->group(function () {
        Route::get('/', 'ClientController@index')->name('client.index');
        Route::get('/create', 'ClientController@create')->name('client.create');
        Route::post('/store', 'ClientController@store')->name('client.store');
        Route::get('/{id}', 'ClientController@show')->name('client.show');
        Route::get('/{id}/edit', 'ClientController@edit')->name('client.edit');
        Route::patch('/{id}', 'ClientController@update')->name('client.update');
        Route::delete('/{id}', 'ClientController@destroy')->name('client.destroy');
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
        Route::get('/changeStatus', 'TaskController@changeStatus')->name('task.changeStatus');
        Route::get('/calander', 'TaskController@calander')->name('task.calander');
//        Route::get('/', array('as'=> 'front.home', 'uses' => 'ItemController@itemView'));
//        Route::post('/update-items', array('as'=> 'update.items', 'uses' => 'ItemController@updateItems'));
    });
    //fullcalender
    Route::prefix('event')->group(function () {
        Route::get('/add', 'EventController@createEvent');
        Route::post('/add', 'EventController@store');
        Route::get('/', 'EventController@calender')->name('event');
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
    //employee
    Route::prefix('employees')->group(function () {
        Route::get('/', 'EmployeeController@index')->name('employee.index');
        Route::get('/create', 'EmployeeController@create')->name('employee.create');
        Route::post('/store', 'EmployeeController@store')->name('employee.store');
        Route::get('/{employee}', 'EmployeeController@show')->name('employee.show');
        Route::get('/{employee}/edit', 'EmployeeController@edit')->name('employee.edit');
        Route::patch('/{employee}', 'EmployeeController@update')->name('employee.update');
        Route::delete('/{id}', 'EmployeeController@destroy')->name('employee.destroy');
    });
    //Category
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category');
        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/{category}', 'CategoryController@show')->name('category.show');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('category.edit');
        Route::patch('/{category}', 'CategoryController@update')->name('category.update');
        Route::delete('/{id}', 'CategoryController@destroy')->name('category.destroy');
    });

});



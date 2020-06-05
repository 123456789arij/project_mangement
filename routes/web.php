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
        Route::get('/dashboard', 'client\DashboradController@index')->name('client.dashborad');
        Route::get('/projects', 'client\ProjectController@index')->name('client.project');
        Route::get('/{project}', 'client\ProjectController@show')->name('client.project.show');
        Route::get('/comments', 'client\CommentController@index')->name('client.comment');
    });
});

//Employee AUthentification
Route::prefix('employee')->group(function () {
    Route::get('/login', 'Auth\EmployeeController@showLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeController@login')->name('employee.login.submit');
    Route::post('logout/', 'Auth\EmployeeController@logout')->name('employee.logout');
    Route::group(['middleware' => 'auth.employee'], function () {
        Route::get('/dashboard', 'employee\DashboradController@index')->name('employee.dashborad');
        //        add employee
        Route::get('/dashboard/employee', 'employee\EmployeeController@index')->name('chef.employee.index');
        Route::get('/create/employee', 'employee\EmployeeController@create')->name('chef.employee.create');
        Route::post('/store/employee', 'employee\EmployeeController@store')->name('chef.employee.store');
        Route::get('/{employee}/edit', 'employee\EmployeeController@edit')->name('chef.employee.edit');
        Route::patch('/{employee}', 'employee\EmployeeController@update')->name('chef.employee.update');
        Route::get('/{employee}', 'employee\EmployeeController@show')->name('chef.employee.show');
        //project
        Route::get('/projects/dashboard', 'employee\ProjectController@index')->name('employee.project');
//task
        Route::get('/dashboard/tasks/', 'employee\TaskController@index')->name('employee.task');
        Route::get('/{project}', 'employee\ProjectController@show')->name('employee.project.show');
        Route::get('/tasks/create', 'employee\TaskController@create')->name('task.create');
        Route::post('/tasks/store', 'employee\TaskController@store')->name('task.store');
        Route::get('/{tasks}/employee', 'employee\TaskController@show')->name('employee.task.show');
        Route::get('/{id}/task/edit', 'employee\TaskController@edit')->name('employee.task.edit');
        Route::patch('/{id}/task/', 'employee\TaskController@update')->name('employee.task.update');
//        comment
        Route::get('/comment', 'employee\CommentController@index')->name('employee.comment');
        Route::get('/create/comment', 'employee\CommentController@create')->name('employee.comment.create');
        Route::post('/store/comment', 'employee\CommentController@store')->name('employee.comment.store');
        Route::post('/reply/add', 'employee\CommentController@replyStore')->name('employee.reply.add');


//employee profile
        Route::get('/profile/em', 'employee\DashboradController@profile')->name('profile');
        Route::get('/{id}/profile', 'employee\DashboradController@edit')->name('employee.profile.edit');
        Route::patch('/employee/{id}', 'employee\DashboradController@update')->name('employee.profile.update');

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


    Route::get('/laravel_google_chart', 'ChartController@index')->name('pieChart');
    Route::get('/donut_chart', 'DonutChartController@index')->name('donut_chart');
    Route::get('/columnChart', 'ColumnChartController@index')->name('column_chart');
//    project
    Route::prefix('projects')->group(function () {
        Route::get('/dashboard/', 'ProjectController@index')->name('project');
        Route::get('/create', 'ProjectController@create')->name('project.create');
        Route::post('/store', 'ProjectController@store')->name('project.store');
        Route::get('/{project}', 'ProjectController@show')->name('project.show');
        Route::get('/{id}/edit', 'ProjectController@edit')->name('project.edit');
        Route::patch('/{id}', 'ProjectController@update')->name('project.update');
        Route::delete('/{id}', 'ProjectController@destroy')->name('project.destroy');


        Route::get('/membre/{id}', 'ProjectController@afficher_membre_projet')->name('membre_projet');
        Route::post('/nouveau/membre/', 'ProjectController@membre_projet')->name('membre');
//Gantt project
//        Route::get('/data/{id}', 'GanttController@get');
        Route::get('/gantt/{id}', 'GanttController@get')->name('gantt');

    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserContoller@index')->name('user');
        Route::get('/{user}/edit', 'UserContoller@edit')->name('user.edit');
        Route::patch('/{user}', 'UserContoller@update')->name('user.update');
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
    Route::get('/calendar', 'CalendarTaskController@index')->name('calendar');

    //task
    Route::prefix('tasks')->group(function () {
        Route::get('/dashboard', 'TaskController@index')->name('task');
        Route::get('/create', 'TaskController@create')->name('task.create');
        Route::post('/store', 'TaskController@store')->name('task.store');
        Route::get('/{task}', 'TaskController@show')->name('task.show');
        Route::get('/{task}/edit', 'TaskController@edit')->name('task.edit');
        Route::patch('/{task}', 'TaskController@update')->name('task.update');
        Route::delete('/{id}', 'TaskController@destroy')->name('task.destroy');
//        comment
        Route::get('/comment', 'CommentController@index')->name('comment');
        Route::get('/comment', 'CommentController@create')->name('comment.create');
        Route::post('/comment/store', 'CommentController@store')->name('comment.store');
        Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');
        Route::get('/changeStatus', 'TaskController@changeStatus')->name('task.changeStatus');
    });
    //fullcalender
    Route::prefix('event')->group(function () {
        Route::get('/fullcalendareventmaster', 'EventController@index')->name('event');
        Route::post('/fullcalendareventmaster/create', 'EventController@create');
        Route::post('/fullcalendareventmaster/update', 'EventController@update');
        Route::post('/fullcalendareventmaster/delete', 'EventController@destroy');
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



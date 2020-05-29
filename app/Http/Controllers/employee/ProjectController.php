<?php

namespace App\Http\Controllers\employee;

use App\Category;
use App\Client;
use App\Employee;
use App\File;
use App\Http\Controllers\Controller;
use App\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = auth()->guard('employee')->user();

        if (auth()->guard('employee')->user()->role == 2) {
            $projects = Project::with('client', 'employees')->whereHas('client', function (Builder $query) {
                $query->whereHas('user', function (Builder $query) {
                    $query->whereHas('departments', function (Builder $query) {
                        $query->where('id', auth()->guard('employee')->user()->department_id);
                    });
                });
            })->paginate(5);
        } else {
//            $projectcount = $employee->projects()->count();
            $projects = $employee->projects()->paginate(5);
        }
        return view('project.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guard('employee')->user()->role == 2) {
            $categories = Category::all();
            $file = File::all();
            $clients = Client::whereHas('user', function (Builder $query) {
                $query->whereHas('departments', function (Builder $query) {
                    $query->where('id', auth()->guard('employee')->user()->department_id);
                });
            })->get();
            return view('employee.project.create', compact('clients', 'categories', 'file'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
            'client_id' => 'required',
            'file' => 'required|file|mimes:doc,docx,pdf,txt|max:2048',
        ]);
        $name = $request->input('name');
        $description = $request->input('description');
        $status = $request->input('status');
        $start_date = $request->input('start_date');
        $deadline = $request->input('deadline');
        $category_id = $request->input('category_id');
        $client_id = $request->input('client_id');
        $files = $request->file('file');

        ProjectRepository::createProject($name, $description, $status, $start_date, $deadline, $category_id, $client_id, $files);
        return redirect()->route('proj')->with('toast_success', ' projet  is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findorfail($id);
        return view('employee.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findorfail($id);
        $categories = Category::all();
        $clients = Client::whereHas('user', function (Builder $query) {
            $query->whereHas('departments', function (Builder $query) {
                $query->where('id', auth()->guard('employee')->user()->department_id);
            });
        })->get();
        return view('employee.project.edit', compact('project', 'clients', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ]);
        $project = Project::findOrFail($id);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        $project->deadline = $request->input('deadline');
        $project->progress_bar = $request->input('my_range');
        $project->status = $request->input('status');
        $project->client_id = $request->input('client_id');
        $project->category_id = $request->input('category_id');
        $project->save();
//        todo
        return redirect()->route('proj')->with('toast_success', ' projet  is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function afficher_membre_projet($id)
    {
        $projet = Project::findOrfail($id);
        $membres = $projet->employees;
        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return view('project.membre', compact('employees', 'membres', 'projet'));
    }

    public function membre_projet(Request $request)
    {
        $emplyeeIds = $request->input('employee_id');
        $projetId = $request->input('project_id');
        $projet = Project::findOrfail($projetId);
        $projet->employees()->sync($emplyeeIds);
        return redirect()->route('proj')->with('toast_success', 'membre is successfully saved');
    }
}

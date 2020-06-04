<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Employee;
use App\File;
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

        /*  $projects = Project::join('clients', 'clients.id', '=', 'projects.client_id')
              ->where('clients.user_id', auth()->user()->id)
              ->select('projects.*')
              ->get();*/

        $projectsCount = Project::with('client', 'employees')->whereHas('client', function (Builder $query) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('id', auth()->user()->id);
            });
        })->count();

        $projects = Project::with('client', 'employees')->whereHas('client', function (Builder $query) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('id', auth()->user()->id);
            });
        })->paginate(5);
        return view('project.index', compact('projects','projectsCount'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $file = File::all();
        $clients = auth()->user()->clients;
        return view('project.create', compact('clients', 'categories', 'file'));
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

        return redirect()->route('project')->with('toast_success', ' projet  is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::withCount('employees')->with('employees')->findorfail($id);
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
//        $clients = Client::whereHas('user', function (Builder $query) {
//                $query->where('id', auth()->user()->id);
//        })->get();
        $project = Project::findorfail($id);


        $clients = Client::with('projects')->whereHas('user', function (Builder $query) {
            $query->where('id', auth()->user()->id);
        })->get();


        return view('project.edit', compact('project', 'clients', 'categories'));
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
        return redirect()->route('project')->with('toast_success', ' projet  is successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('project')->with('success', 'Project is successfully deleted');
    }

    public function afficher_membre_projet($id)
    {
        $project = Project::findOrfail($id);
        $membres = $project->employees;
        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return view('project.membre', compact('employees', 'membres', 'project'));
    }

    public function membre_projet(Request $request)
    {
        $emplyeeIds = $request->input('employee_id');
        $projectId = $request->input('project_id');
        $project = Project::findOrfail($projectId);
        $project->employees()->sync($emplyeeIds);
        return redirect()->route('project')->with('toast_success', 'membre is successfully saved');
    }



}

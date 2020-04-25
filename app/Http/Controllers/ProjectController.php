<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Employee;
use App\File;
use App\Project;
use App\Projet;
use Carbon\Carbon;
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
        $projects = Project::whereHas('client', function (Builder $query) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('id', auth()->user()->id);
            });
        })->get();
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //todo just your clients
        $categories = Category::all();
        $file=File::all();
        $clients = auth()->user()->clients;
        return view('project.create', compact('clients', 'categories','file'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo upload file
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
            'client_id' => 'required',
        ]);

        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->status = $request->input('status');
        $project->start_date = $request->input('start_date');
        $project->deadline = $request->input('deadline');
        $project->category_id = $request->input('category_id');
        $project->client_id = $request->input('client_id');
        $files = $request->file('file');

        $project->save();
      dd($files);
        if ($files) {

            $destinationPath = '/files/';
            $file_doc = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('files'), $file_doc);

            $file = new File();
            $file->path = $destinationPath . $file_doc;
            dd($request->file('file'));
            $project->fileable($file)->save();
        }

        return redirect()->route('project')->with('toast_success', ' projet  is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        //todo your client
        $clients = Client::all();
        return view('project.edit', compact('project', 'categories', 'clients'));
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
            'category_id' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
            'client_id' => 'required',
        ]);
        $project = Project::findOrFail($id);
        $input = $request->all();
        $project->fill($input)->save();
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
        return redirect()->route('project')->with('success', 'produit is successfully deleted');
    }

    public function afficher_membre_projet()
    {
        $projet = Project::findOrfail(2);
        $membres=$projet->employees;
        $employees = Employee::all();
        return view('project.membre', compact('employees','membres'));
    }

    public function membre_projet(Request $request)
    {
        $emplyeeIds = $request->input('employee_id');
        $projetId = $request->input('project_id');
        $projet = Project::findOrfail(2);
        $projet->employees()->sync($emplyeeIds);
        return redirect()->route('project')->with('toast_success', 'membre is successfully saved');
    }












}

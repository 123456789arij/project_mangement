<?php


namespace App\Repositories;


use App\File;
use App\Project;

class ProjectRepository
{

    public static function createProject($name, $description, $status, $start_date, $deadline, $category_id, $client_id,$files)
    {
        $project = new Project();
        $project->name = $name;
        $project->description = $description;
        $project->status = $status;
        $project->start_date = $start_date;
        $project->deadline = $deadline;
        $project->category_id = $category_id;
        $project->client_id = $client_id;
        $project->save();
        if ($files) {

            $destinationPath = '/files/';
            $file_doc = time() . "." . $files->getClientOriginalExtension();
            $files->move(public_path('files'), $file_doc);
            $file = new File();
            $file->path = $destinationPath . $file_doc;
            $project->files()->save($file);
        }
        return $project;
    }

}

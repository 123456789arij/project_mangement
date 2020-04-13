<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = \App\Project::all();
        $tasks = \App\Task::all();

        $paths = [
            '/uploads/$folder/$file.pdf',
            '/uploads/$folder/$file.csv',
            '/uploads/$folder/$file.png',
            '/uploads/$folder/$file.jpg',
            '/uploads/$folder/$file.xlsx',
        ];

        foreach ($projects as $project) {
            foreach ($paths as $path) {
                $file = new \App\File();
                $file->path = str_replace(['$folder', '$file'], ['projects', 'project' . $project->id . 'file'], $path);

                $project->files()->save($file);
            }
        }

        foreach ($tasks as $task) {
            foreach ($paths as $path) {
                $file = new \App\File();
                $file->path = str_replace(['$folder', '$file'], ['tasks', 'task' . $task->id . 'file'], $path);

                $task->files()->save($file);
            }
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('projectsdb.project');

        foreach ($projects as $project) {
            $newproject = new Project();
            $newproject->project_name = $project['project_name'];
            $newproject->slug = $project['slug'];
            $newproject->description = $project['description'];
            $newproject->preview_image = $project['preview_image'];
            $newproject->year_project = $project['year_project'];
            $newproject->link_video = $project['link_video'];
            $newproject->link_view = $project['link_view'];
            $newproject->link_git = $project['link_git'];
            $newproject->save();


        }
    }
}

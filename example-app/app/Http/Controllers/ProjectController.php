<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getProject() {
        $projects = Project::where('status', 'done')->get();
        foreach ($projects as $project) {
            dump($project->title);
        }
        dd('end');
    }
}

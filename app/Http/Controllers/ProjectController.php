<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function Dashboard()
    {
        $projects = Project::all();
        // return($projects);

        return inertia('Dashboard', ['projects' => $projects]);
    }
    public function Projects()
    {
        $projects = Project::all();
        // return($projects);

        return inertia('Projects/Index', ['projects' => $projects]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        // $projects = Project::all();
        // // return($projects);

        // return inertia('Dashboard', ['projects' => $projects]);
        return inertia('Dashboard');
    }
}

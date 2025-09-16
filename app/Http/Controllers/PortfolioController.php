<?php

namespace App\Http\Controllers;

use App\Models\Achievements;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        $project = Project::where('status', 'active')
            ->orderBy('pinned', 'desc')   // pinned = 1 akan di atas
            ->orderBy('created_at', 'desc') // terbaru di atas
            ->get();
        $sertif = Achievements::where('status', 'active')->orderBy('created_at', 'desc')->get();

        $projectabout = Project::where('status', 'active')->orderBy('created_at', 'desc')->limit(5)->get();
        // dd($projectabout);
        return Inertia::render('Welcome',  [
            'project' => $project,
            'sertif' => $sertif,
            'projectabout' => $projectabout
        ]);
    }

    public function detail($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return Inertia::render('Detail', [
            'project' => $project
        ]);
    }
}

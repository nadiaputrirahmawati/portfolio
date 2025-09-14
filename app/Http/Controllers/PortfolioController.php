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
        $sertif = Achievements::where('status', 'active')->get();
        // dd($project);
        return Inertia::render('Welcome',  [
            'project' => $project,
            'sertif' => $sertif
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

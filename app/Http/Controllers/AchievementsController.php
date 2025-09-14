<?php

namespace App\Http\Controllers;

use App\Models\Achievements;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Inertia\Inertia;

class AchievementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievements::all();
        return Inertia::render('Achievements/index', [
            'achievements' => $achievements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Achievements/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|in:active,inactive',
            'link'        => 'required|string|max:255',
            'credentials' => 'required|string|max:255',
        ]);


        $path = $request->file('image')->store('achievement', 'public');

        $validated['image'] = 'storage/' . $path;

        Achievements::create($validated);

        return redirect()->route('achievements.index')->with('success', 'Project berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

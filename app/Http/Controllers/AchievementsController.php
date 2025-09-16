<?php

namespace App\Http\Controllers;

use App\Models\Achievements;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('achievements.index')->with('success', 'Achievement berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $achievement = Achievements::findOrFail($id);
        // dd($achievement);
        return Inertia::render('Achievements/edit', [
            'achievement' => $achievement
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $achievement = Achievements::findOrFail($id);
        
        // dd($request);
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|in:active,inactive',
            'link'        => 'nullable|string|max:255',
            'credentials' => 'nullable|string|max:255',
        ]);
        // kalau ada upload image baru
        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($achievement->image && str_starts_with($achievement->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $achievement->image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('achievement', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $achievement->update($validated);

        return redirect()->route('achievements.index')->with('success', 'Achievement berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achievement = Achievements::findOrFail($id);

        // hapus file image kalau ada
        if ($achievement->image && str_starts_with($achievement->image, 'storage/')) {
            $oldPath = str_replace('storage/', '', $achievement->image);
            Storage::disk('public')->delete($oldPath);
        }

        $achievement->delete();

        return redirect()->route('achievements.index')->with('success', 'Achievement berhasil dihapus.');
    }
}

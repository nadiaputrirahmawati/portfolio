<?php

namespace App\Http\Controllers;

use App\Models\Project;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return Inertia::render('Project/Index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Project/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string', // hapus max:255 karena markdown bisa panjang
            'image'       => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'link'        => 'required|string',
            'code'        => 'required|string',
            'skill'       => 'required|array',
            'status'      => 'required|in:active,inactive',
            'pinned'      => 'required|boolean',
        ]);

        // Upload file ke Cloudinary
        $path = $request->file('image')->store('project', 'public');
        $validated['projects_id'] = rand(1, 100);
        $validated['slug'] = Str::slug($validated['title']);


        // Simpan path URL-nya
        $validated['image'] = 'storage/' . $path;

        // Simpan ke database
        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'image|max:10240', // maksimal 10MB
        ]);

        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No image uploaded'], 400);
        }

        try {
            $file = $request->file('file');

            // Upload ke Cloudinary via Laravel Storage
            $path = Storage::disk('cloudinary')->putFileAs(
                'foto/project',              // folder tujuan di Cloudinary
                $file,                       // file dari request
                $file->hashName()            // nama file unik (otomatis di-hash)
            );

            // Ambil URL publiknya
            $url = Storage::disk('cloudinary')->url($path);

            return response()->json([
                'location' => $url, // <-- HARUS "location"
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Upload failed: ' . $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::find($id);
        return Inertia::render('Project/Edit', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return Inertia::render('Project/Edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'link'        => 'required|string',
            'code'        => 'required|string',
            'pinned'      => 'required|boolean',
            'skill'       => 'required|array',
            'status'      => 'required|in:active,inactive',
        ]);

        // Cek apakah title berubah
        if ($validated['title'] !== $project->title) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = $project->slug; // pakai slug lama
        }

        // File upload handling
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('project', 'public');
            $validated['image'] = 'storage/' . $path;

            if ($project->image && file_exists(public_path($project->image))) {
                @unlink(public_path($project->image));
            }
        } else {
            $validated['image'] = $project->image;
        }

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::find($id);
        $projects->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}

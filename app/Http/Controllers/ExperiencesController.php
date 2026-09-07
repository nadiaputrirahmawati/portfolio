<?php

namespace App\Http\Controllers;

use App\Models\Experiences;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experiences::orderBy('start_date', 'desc')->paginate(1);
        return Inertia::render('experiences/index', [
            'experiences' => $experiences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('experiences/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Siapkan rules dasar
        $rules = [
            'company_name' => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'location'     => 'nullable|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'work_model'   => 'nullable|string|max:255',
            'description'  => 'nullable|string',
        ];

        // 2. Cek apakah company_logo berupa file gambar atau teks string
        if ($request->hasFile('company_logo')) {
            $rules['company_logo'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['company_logo'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);

        // 3. Simpan file jika ada (akan me-replace string dengan path gambar)
        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        Experiences::create($validated);

        return redirect()->route('experiences.index')->with('message', 'Pengalaman kerja berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experiences $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experiences $experience)
    {
        return Inertia::render('experiences/edit', [
            'experience' => $experience
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experiences $experience)
    {
        // 1. Siapkan rules dasar
        $rules = [
            'company_name' => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'location'     => 'nullable|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'work_model'   => 'nullable|string|max:255',
            'description'  => 'nullable|string',
        ];

        // 2. Validasi dinamis untuk company_logo
        if ($request->hasFile('company_logo')) {
            $rules['company_logo'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        } else {
            $rules['company_logo'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);

        // 3. Simpan file jika ada upload baru
        if ($request->hasFile('company_logo')) {
            // Hapus logo lama dari storage jika sebelumnya berupa file/gambar
            if ($experience->company_logo && !str_starts_with($experience->company_logo, 'http') && !preg_match('/^[a-zA-Z0-9\s]+$/', $experience->company_logo)) {
                Storage::disk('public')->delete($experience->company_logo);
            }
            
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $experience->update($validated);

        return redirect()->route('experiences.index')->with('message', 'Pengalaman kerja berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experiences $experience)
    {
        // Opsional: Hapus file gambar dari storage jika dihapus
        if ($experience->company_logo && Storage::disk('public')->exists($experience->company_logo)) {
            Storage::disk('public')->delete($experience->company_logo);
        }

        $experience->delete();
        
        return redirect()->route('experiences.index')->with('message', 'Pengalaman kerja dihapus!');
    }
}
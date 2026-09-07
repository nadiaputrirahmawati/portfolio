<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Experiences;
use App\Models\Achievements; // Sesuaikan jika nama modelmu berbeda
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Mengambil data Projects
     */
    public function projects()
    {
        // Opsional: Hanya mengambil project yang statusnya 'active'
        $projects = Project::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Projects berhasil diambil',
            'data'    => $projects
        ], 200);
    }

    /**
     * Mengambil data Experiences
     */
    public function experiences()
    {
        $experiences = Experiences::select('id', 'company_name', 'position', 'location', 'start_date', 'end_date', 'work_model', 'description', 'company_logo')->orderBy('start_date', 'desc')->get()
        ->map(function ($exp) {
            $exp->is_current = is_null($exp->end_date);
            return $exp;
        });

        return response()->json([
            'success' => true,
            'message' => 'Data Experiences berhasil diambil',
            'data'    => $experiences
        ], 200);
    }

    /**
     * Mengambil data Achievements
     */
    public function achievements()
    {
        $achievements = Achievements::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Achievements berhasil diambil',
            'data'    => $achievements
        ], 200);
    }

    /**
     * (Bonus) Mengambil SEMUA data dalam 1 request
     * Sangat berguna agar frontend tidak perlu hit API berkali-kali
     */
    public function allData()
    {
        return response()->json([
            'success' => true,
            'message' => 'Semua data portofolio berhasil diambil',
            'data'    => [
                'projects'     =>  $project = Project::where('status', 'active')
                    ->orderBy('pinned', 'desc') 
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'experiences'  => Experiences::orderBy('start_date', 'desc')->get(),
                'achievements' => Achievements::orderBy('created_at', 'desc')->get(),
            ]
        ], 200);
    }

    public function detailData(Request $request)
    {
        $id = $request->slug;
        $projects = Project::where('slug', $id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Data Projects berhasil diambil',
            'data'    => $projects
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $officerQuery = $request->input('officer');

        // Cek jika officerQuery ada atau sama dengan 'all'
        if ($officerQuery == "all") {
            $complaints = Complaint::with('users')->orderBy('created_at', 'desc')->get();
            return ResponseFormatter::success(
                $complaints,
                'Data pengaduan berhasil diambil'
            );
        } elseif ($officerQuery) {
            // Cari keluhan berdasarkan nama atau username officer
            $complaints = Complaint::with('users')
                ->whereHas('users', function ($query) use ($officerQuery) {
                    $query->where('name', 'like', '%' . $officerQuery . '%')
                        ->orWhere('username', 'like', '%' . $officerQuery . '%');
                })
                ->orderBy('created_at', 'desc')
                ->get();

            if ($complaints->isNotEmpty()) {
                return ResponseFormatter::success(
                    $complaints,
                    'Data pengaduan berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data pengaduan tidak ada',
                    404
                );
            }
        } else {
            return ResponseFormatter::error(
                null,
                'Parameter officer tidak disediakan',
                400
            );
        }
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'describe' => 'required|string',
            'photo' => 'nullable|string',
        ]);

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Buat keluhan baru dengan status 'pending'
        $complaint = Complaint::create([
            'tittle' => $validatedData['title'],
            'describe' => $validatedData['describe'],
            'photo' => $validatedData['photo'] ?? null,
            'user_id' => $user->id,
            'officer' => $user->name,  
            'company_id' => $user->company_id,
            'status' => 'pending',
        ]);

        // Return response dengan ResponseFormatter
        return ResponseFormatter::success(
            $complaint,
            'Complaint created successfully'
        );
    }
}

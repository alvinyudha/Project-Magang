<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\TariffGroup;
use App\Models\TariffLevel;
use Illuminate\Support\Facades\Auth;

class TariffGroupController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tariff_groups = TariffGroup::where('user_id', $user->id)->get();
        $tariffLevels = TariffLevel::with('tariffGroup')->whereIn('group_id', $tariff_groups->pluck('id'))->get();
        $companies = Company::where('id_company', $user->company_id)->get();
        // dd($companies);
        return view('pages.superadmin.tariff-group.index', compact('tariff_groups', 'tariffLevels', 'companies'));
    }

    public function create()
    {
        return view('pages.superadmin.tariff-group.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'group' => 'required|in:progresif,progresif_dua,non_progresif_rendah,non_progresif_tinggi',
            'group_name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Simpan data Tariff Group dengan ID user yang sedang login
        $tariffGroup = TariffGroup::create([
            'group' => $validatedData['group'],
            'group_name' => $validatedData['group_name'],
            'desc' => $validatedData['desc'],
            'user_id' => $userId,
        ]);

        // Redirect ke halaman create Tariff Level dengan mengirimkan ID Tariff Group sebagai parameter
        return redirect()->route('tariff-level-create', ['group_id' => $tariffGroup->id])->with('success', 'Tarif Grup berhasil ditambahkan! Sekarang tambahkan Tarif Level.');
    }
}

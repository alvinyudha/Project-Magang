<?php

namespace App\Http\Controllers;

use App\Models\TariffGroup;
use Illuminate\Http\Request;
use App\Models\TariffLevel;

class TariffLevelController extends Controller
{
    public function create($group_id)
    {
        // Mengirimkan ID Tariff Group ke halaman createT ariff Level
        return view('pages.superadmin.tariff-level.create', compact('group_id'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'group_id' => 'required|exists:tariff_groups,id',
            'tariff_type' => 'required|in:non-progresif_rendah,non-progresif_tinggi,progresif,progresif_dua',
            'level.*' => 'required',
            'tariff.*' => 'required|numeric',
        ]);

        // Simpan data Tariff Level sesuai dengan tipe tarif yang dipilih
        $tariffType = $validatedData['tariff_type'];

        if ($tariffType === 'non-progresif_rendah' || $tariffType === 'non-progresif_tinggi') {
            foreach ($validatedData['level'] as $key => $level) {
                TariffLevel::create([
                    'group_id' => $validatedData['group_id'],
                    'level' => $level,
                    'tariff' => $validatedData['tariff'][$key],
                ]);
            }
        } elseif ($tariffType === 'progresif') {
            // Menggunakan indeks untuk menangani level dan tariff
            for ($i = 0; $i < count($validatedData['level']); $i++) {
                TariffLevel::create([
                    'group_id' => $validatedData['group_id'],
                    'level' => $validatedData['level'][$i],
                    'tariff' => $validatedData['tariff'][$i],
                ]);
            }
        } elseif ($tariffType === 'progresif_dua') {
            // Menggunakan indeks untuk menangani level dan tariff
            for ($i = 0; $i < count($validatedData['level']); $i++) {
                TariffLevel::create([
                    'group_id' => $validatedData['group_id'],
                    'level' => $validatedData['level'][$i],
                    'tariff' => $validatedData['tariff'][$i],
                ]);
            }
        }

        // Redirect ke halaman index atau halaman lain yang sesuai
        return redirect()->route('superadmin-tariff-group')->with('success', 'Tarif Level berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'group_name' => 'required|string|exists:tariff_groups,group_name',
            'level' => 'required|numeric',
            'tariff' => 'required|numeric',
            'desc' => 'string',
        ]);

        // Cari Tariff Level berdasarkan ID
        $tariffLevel = TariffLevel::find($id);

        // Jika Tariff Level ditemukan
        if ($tariffLevel) {
            // Temukan atau buat TariffGroup berdasarkan nama grup yang diberikan
            $tariffGroup = TariffGroup::where('group_name', $validatedData['group_name'])->first();

            if ($tariffGroup) {
                // Update data Tariff Level
                $tariffLevel->update([
                    'group_id' => $tariffGroup->id,
                    'level' => $validatedData['level'],
                    'tariff' => $validatedData['tariff'],
                    'desc' => $validatedData['desc'],
                ]);

                // Redirect ke halaman index atau halaman lain yang sesuai
                return redirect()->back()->with('success', 'Tarif Level berhasil dirubah!');
            } else {
                return redirect()->back()->with('failed', 'Tarif Grup tidak ditemukan!');
            }
        } else {
            return redirect()->back()->with('failed', 'Tarif Level tidak ditemukan!');
        }
    }


    public function destroy($id)
    {
        // Cari tariff group berdasarkan ID
        $tariffGroup = TariffGroup::find($id);

        // Jika tariff group ditemukan
        if ($tariffGroup) {
            // Hapus semua tariff level dalam grup
            TariffLevel::where('group_id', $id)->delete();
            // Hapus juga tariff group itu sendiri
            $tariffGroup->delete();
            return redirect()->route('superadmin-tariff-group')->with('success', 'Tarif Grup dan semua Tarif Level berhasil dihapus!');
        } else {
            return redirect()->route('superadmin-tariff-group')->with('failed', 'Tarif Grup tidak ditemukan!');
        }
    }
}

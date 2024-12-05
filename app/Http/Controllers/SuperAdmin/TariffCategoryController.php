<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\TariffCategory;
use Illuminate\Http\Request;

class TariffCategoryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tariff_category = TariffCategory::where('user_id', $user->id)->get();
        $companies = Company::where('id_company', $user->company_id)->get();

        return view('pages.superadmin.tariff-group.index', compact('tariff_category', 'companies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer',
            'group_name' => 'required|string',
            'tariff' => 'required|integer',
            'desc' => 'required|string',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $tariff = TariffCategory::create($validatedData);
        $tariff->save();
        return redirect()->back()->with('success', 'Tariff category created successfully.');
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'group_name' => 'required|string',
            'tariff' => 'required|integer',
            'desc' => 'required|string',
        ]);
        $tariffCategory = TariffCategory::findOrFail($id);
        $tariffCategory->update($validatedData);
        return redirect()->back()->with('success', 'Kategori tarif berhasil diubah');
    }

    public function delete($id)
    {
        $user = TariffCategory::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Category has been deleted');
    }
}

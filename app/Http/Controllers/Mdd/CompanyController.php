<?php

namespace App\Http\Controllers\Mdd;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = DB::table('company')->get();
        return view('pages.mdd.company.index', compact('company'));
    }

    public function details($id_company)
    {
        $company = Company::findOrFail($id_company);
        return view('pages.mdd.company.company-data', compact('company'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storecom(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'fax' => 'required',
            'pict' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            'no_telp' => 'required',
        ]);
        $files = $request->only(['pict']);
        foreach ($files as $key => $image) {
            if ($image) {
                $fileName = date('Y-m-d') .  $image->getClientOriginalName();
                $image->move(public_path('image-company'), $fileName);
                $files[$key] = $fileName;
            }
        }
        // $filename = date('Y-m-d') . $image->getClientOriginalName();
        // $path = 'photo-company/' . $filename;
        // Storage::disk('public')->put($path, file_get_contents($image));
        $randomLetters = strtoupper(Str::random(3, 'abcdefghijklmnopqrstuvwxyz'));
        $companyCode = $randomLetters;


        $company = new Company();
        $company->company_code = $companyCode;
        $company->name = $validatedData['name'];
        $company->address = $validatedData['address'];
        $company->email = $validatedData['email'];
        $company->fax = $validatedData['fax'];
        $company->pict = $files['pict'];
        $company->no_telp = $validatedData['no_telp'];

        $company->save();

        return redirect()->back()->with('success', 'Data Perusahaan berhasil ditambahkan');
    }

    public function storebea(Request $request)
    {
        // Anda perlu menyesuaikan cara Anda mengidentifikasi pengguna yang login
        $user = Auth::user(); // Contoh menggunakan Auth

        // Mendapatkan perusahaan yang sedang digunakan oleh pengguna yang login
        $company = $user->company;

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'retribution' => 'required|numeric',
            'fines' => 'required|numeric',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Menyimpan data retribusi ke perusahaan yang ditemukan
        $company->retribution = $validatedData['retribution'];
        $company->fines = $validatedData['fines'];
        // Tambahkan atribut lain sesuai kebutuhan

        $company->save();

        return redirect()->back()->with('success', 'Retribusi dan Denda telah diatur.');
    }

    public function updatecom(Request $request, $id_company)
    {
        $validatedData = $request->validate([
            'name' => '',
            'address' => '',
            'email' => '',
            'fax' => '',
            'pict' => '',
            'no_telp' => '',
        ]);

        $company = Company::findOrFail($id_company);
        $company->name = $validatedData['name'];
        $company->address = $validatedData['address'];
        $company->email = $validatedData['email'];
        $company->fax = $validatedData['fax'];
        $company->no_telp = $validatedData['no_telp'];
        $files = $request->only(['pict']);
        foreach ($files as $key => $image) {
            if ($image) {
                $fileName = date('Y-m-d') .  $image->getClientOriginalName();
                $image->move(public_path('image-company'), $fileName);
                $files[$key] = $fileName;
            }
        }
        if (isset($files['pict'])) {
            $company->pict = $files['pict'];
        }
        // Simpan objek Company yang sudah diperbarui
        $company->save();

        return redirect()->back()->with('success', 'Data Perusahaan telah diubah');
    }

    public function deletecom(string $id_company)
    {
        $company = Company::findOrFail($id_company);

        $company->delete();
        return redirect()->back()->with('success', 'Perusahaan berhasil dihapus!');
    }
}

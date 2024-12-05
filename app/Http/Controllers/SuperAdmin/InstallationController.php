<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\RecordMeter;
use App\Models\TariffCategory;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstallationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Customer::where('user_id', $user->id);

        if ($request->has('search') && $request->input('search') != '') {
            $query->where(function ($q) use ($request) {
                $q->where('customer_code', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('name', 'like', '%' . $request->input('search') . '%');
            });
        } else {
            $customer = [];
        }
        $customer = $query->get();

        $tariffgroupall = TariffCategory::where('user_id', $user->id)->get();
        $tariffgroup = $customer->load('tariffGroup');
        $companny = $customer->load('company');

        if ($request->has('modal') && $request->input('modal') === 'true') {
            // If the request is coming from the modal, return a partial view
            return view('pages.superadmin.installation.addrecordmeter', compact('customer', 'tariffgroup', 'tariffgroupall', 'companny'));
        } else {
            // If the request is not coming from the modal, return the full page
            return view('pages.superadmin.installation.index', compact('customer', 'tariffgroup', 'tariffgroupall', 'companny'));
        }
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $query = Customer::where('user_id', $user->id);

        if ($request->has('search') && $request->input('search') != '') {
            $query->where(function ($q) use ($request) {
                $q->where('customer_code', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('name', 'like', '%' . $request->input('search') . '%');
            });
        }

        $customer = $query->get();
        $tariffgroupall = TariffCategory::where('user_id', $user->id)->get();
        $tariffgroup = $customer->load('tariffGroup');
        $companny = $customer->load('company');

        return view('pages.superadmin.installation.addrecordmeter', compact('customer', 'tariffgroup', 'tariffgroupall', 'companny'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identity_card_number' => 'required|max:10',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'no_telp' => 'required',
            'location' => 'required|max:255',
            'land_status' => 'required|max:255',
            'land_area' => 'required',
            'building_area' => 'required',
            'meter_number' => 'required|max:255',
            'group_id' => 'required|integer',
        ]);

        // Mendapatkan nomor urut terbaru
        $companyId = Auth::user()->company_id;
        $company = Company::find($companyId);
        $companyName = strtoupper(substr($company->name, 0, 2));
        $companyCode = $company->company_code;

        $latestCustomer = Customer::where('customer_code', 'like', '%' . $companyCode . '%')
            ->latest()
            ->first();
        $latestNumber = $latestCustomer ? intval(substr($latestCustomer->customer_code, -4)) : 0;
        $newNumber = $latestNumber + 1;
        $paddedNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // $customerName = $validatedData['name'];
        // $userInitial = strtoupper(substr($customerName, 0, 1));
        // $timestamp =  now()->format('ymd');

        $customer = new Customer();
        $customerCode =  $companyName . $companyCode . $paddedNumber;
        $customer->customer_code = $customerCode;
        $customer->identity_card_number = $validatedData['identity_card_number'];
        $customer->name = $validatedData['name'];
        $customer->address = $validatedData['address'];
        $customer->no_telp = $validatedData['no_telp'];
        $customer->group_id = $validatedData['group_id'];
        $customer->location = $validatedData['location'];
        $customer->land_status = $validatedData['land_status'];
        $customer->land_area = $validatedData['land_area'];
        $customer->building_area = $validatedData['building_area'];
        $customer->meter_number = $validatedData['meter_number'];
        $customer->user_id = auth()->user()->id;
        $loggedInUser = auth()->user();
        $customer->company_id =  $loggedInUser->company_id;
        $customer->save();
        return redirect()->back()->with('success', 'Data Pasang Baru berhasil ditambahkan');
    }
    public function update(Request $request, $id_customer)
    {
        $validatedData = $request->validate([
            'identity_card_number' => 'required|max:10',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'no_telp' => 'required|max:15',
            'location' => 'required|max:255',
            'land_status' => 'required|max:255',
            'land_area' => 'required',
            'building_area' => 'required',
            'meter_number' => 'required|max:255',
            'group_id' => 'required|integer',
        ]);
        // Temukan pengguna yang akan diperbarui
        $customer = Customer::findOrFail($id_customer);

        $customer->identity_card_number = $validatedData['identity_card_number'];
        $customer->name = $validatedData['name'];
        $customer->address = $validatedData['address'];
        $customer->no_telp = $validatedData['no_telp'];
        $customer->group_id = $validatedData['group_id'];
        $customer->location = $validatedData['location'];
        $customer->land_status = $validatedData['land_status'];
        $customer->land_area = $validatedData['land_area'];
        $customer->building_area = $validatedData['building_area'];
        $customer->meter_number = $validatedData['meter_number'];

        // $files = $request->only(['identity_card', 'family_card', 'property_tax', 'land_document', 'electricity_account']);

        // foreach ($files as $key => $file) {
        //     if ($file) {
        //         $fileName = $file->getClientOriginalName();
        //         $file->move(public_path('pdf'), $fileName);
        //         $files[$key] = $fileName;
        //     }
        // }

        // if (isset($files['identity_card'])) {
        //     $customer->identity_card = $files['identity_card'];
        // }
        // if (isset($files['family_card'])) {
        //     $customer->family_card = $files['family_card'];
        // }
        // if (isset($files['property_tax'])) {
        //     $customer->property_tax = $files['property_tax'];
        // }
        // if (isset($files['land_document'])) {
        //     $customer->land_document = $files['land_document'];
        // }
        // if (isset($files['electricity_account'])) {
        //     $customer->electricity_account = $files['electricity_account'];
        // }
        $customer->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data Pasang Baru telah diubah');
    }
    public function delete($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        $customer->delete();
        return redirect()->back()->with('success', 'Data Pasang Baru berhasil dihapus');
    }

    public function deleteall()
    {
        $user = auth()->user();
        Customer::where('user_id', $user->id)->delete();

        return redirect()->back()->with('success', 'Semua data telah dihapus');
    }
    public function isolate($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);
        // Cek jika status saat ini adalah 'avaliable'
        if ($customer->status == 'avaliable') {
            $customer->status = 'isolated';
            $customer->save();

            return redirect()->back()->with('success', 'Pelanggan Telah Di Isolasi');
        }
        // Cek jika status saat ini adalah 'isolated'
        elseif ($customer->status == 'isolated') {
            $customer->status = 'avaliable';
            $customer->save();

            return redirect()->back()->with('success', 'isolasi Telah Di buka');
        }
    }
}
<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\RecordMeter;
use App\Models\TariffCategory;
use App\Models\TariffGroup;
use Carbon\Carbon;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class RecordMeterController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rmeter =  RecordMeter::where('user_id', $user->id)->get();
        $customer = RecordMeter::with('customer')->get(); // ambil function foreign key customer pada model record meter
        return view('pages.superadmin.record-meter.index', compact('rmeter', 'customer'));
    }
    public function addMeter(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'current_meter' => 'required|numeric',
            'meter_photos' => 'nullable|image|max:2048',
        ]);
        // Ambil tanggal pembacaan terakhir
        $lastReading = RecordMeter::where('id_customer', $validatedData['id_customer'])
            ->latest()
            ->first();

        // Cek apakah sudah 1 bulan sejak input terakhir
        $lastReadingDate = $lastReading ? $lastReading->date : null;
        $oneMonthLater = $lastReadingDate ? Carbon::parse($lastReadingDate)->addMonth() : null;

        if ($oneMonthLater && $oneMonthLater->isFuture()) {
            return redirect()->back()->with('failed', 'Anda hanya dapat input data meter setelah 1 bulan sejak input terakhir.');
        }

        // Upload foto meter jika ada
        $meterPhotosPath = null;
        if ($request->hasFile('meter_photos')) {
            $meterPhotosPath = $request->file('meter_photos')->store('meter-photos', 'public');
        }

        $lastMeter = $lastReading ? $lastReading->current_meter : 0;

        // Simpan data baru
        $user = auth()->user()->id;
        $meterReading = RecordMeter::create([
            'id_customer' => $validatedData['id_customer'],
            'date' => Carbon::now(),
            'last_meter' => $lastMeter,
            'current_meter' => $validatedData['current_meter'],
            'meter_photos' => $meterPhotosPath,
            'user_id' => $user
        ]);
        $meterReading->save();

        $customer = Customer::findOrFail($validatedData['id_customer']);
        $usageAmount = $validatedData['current_meter'] - $lastMeter;
        // Ambil tarif dari TariffCategory
        $tariffCategory = TariffCategory::find($customer->group_id);
        $tariff = $tariffCategory ? $tariffCategory->tariff : 0;
        $totalBill = $usageAmount * $tariff;

        $bill = Bill::create([
            'customer_id' => $meterReading->id_customer,
            'record_meter_id' => $meterReading->id,
            'usage_amount' => $usageAmount,
            'total_bill' => $totalBill,
            'status' => 'unpaid',
            'last_meter' => $lastMeter,
            'current_meter' =>  $meterReading->current_meter,
            'user_id' => $user
        ]);
        $bill->save();
        return redirect()->route('superadmin-install')->with('success', 'Data meter berhasil disimpan.');
    }
    public function deleteall()
    {
        $user = auth()->user();
        RecordMeter::where('user_id', $user->id)->delete();

        return redirect()->back()->with('success', 'Semua data telah dihapus');
    }
}

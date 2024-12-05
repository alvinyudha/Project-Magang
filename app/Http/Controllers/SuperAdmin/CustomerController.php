<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $customer =  Customer::where('user_id', $user->id)->get();
        $tariffgroup = Customer::with('tariffGroup')->get();
        $tariffgroupall = DB::table('tariff_groups')->get();
        $companny = Customer::with('company')->get();


        return view('pages.superadmin.barcode.index', compact('customer', 'tariffgroup', 'tariffgroupall', 'companny'));
    }

    public function cetakBarcode(Request $request)
    {
        $customerData = array();
        foreach ($request->customer_codes as $cd) {
            $customerData[] = $cd;
        }
        $no  = 1;
        $pdf = PDF::loadView('pages.superadmin.barcode.barcode', compact('customerData', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('customer.pdf');
    }
}

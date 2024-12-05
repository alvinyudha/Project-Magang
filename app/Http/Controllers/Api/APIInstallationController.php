<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIInstallationController extends Controller
{
    public function show(Request $request)
    {
        $customer = Customer::with(['tariffGroup', 'user'])->get();

        return response()->json([
            'installation' => $customer,
        ]);
        // return ResponseFormatter::success(
        //     $tariffgroup,
        //     $users,
        //     'Data customer berhasil diambil'
        // );
    }
}

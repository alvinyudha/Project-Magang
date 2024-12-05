<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id_customer');
        $customerCode = $request->input('customer_code');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $address = $request->input('address');
        $no_telp = $request->input('no_telp');
        $location = $request->input('location');
        $land_status = $request->input('land_status');
        $land_area = $request->input('land_area');
        $building_area = $request->input('building_area');
        $meter_number = $request->input('meter_number');
        $identity_card = $request->input('identity_card');
        $family_card = $request->input('family_card');
        $property_tax = $request->input('property_tax');
        $land_document = $request->input('land_document');
        $electricity_account = $request->input('electricity_account');
        $user = $request->input('user');

        if ($customerCode == "all") {
            $customer = Customer::with(['tariffGroup', 'user', 'tariffCategory']);
    
            return ResponseFormatter::success(
                $customer->paginate($limit),
                'Data customer berhasil diambil'
            );
        }elseif ($customerCode) {
            # code...
            $customer = Customer::with(['tariffGroup', 'user', 'tariffCategory'])->where('customer_code', $customerCode)->first();

            if ($customer) {
                return ResponseFormatter::success(
                    $customer,
                    'Data customer berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data customer tidak ada',
                    404
                );
            }
        }else {
            return ResponseFormatter::error(
                null,
                'Data tidak ada',
                404
            );
            # code...
        }

    }
}
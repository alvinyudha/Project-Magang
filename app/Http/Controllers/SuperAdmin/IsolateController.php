<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Disolir;
use Illuminate\Http\Request;

class IsolateController extends Controller
{
    public function index()
    {
        $userID = auth()->user()->id;
        $isolate = Customer::where('user_id', $userID)->where('status', 'isolated')->get();
        $comp = Customer::with('company')->get();
        $tariff = Customer::with('tariffGroup')->get();
        return view('pages.superadmin.disolir.index', compact('isolate', 'comp', 'tariff'));
    }
}

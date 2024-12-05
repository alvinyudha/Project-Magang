<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\CustomerExport;
use App\Exports\PaymentExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\TariffCategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function reportCustomer(Request $request)
    {
        $user = auth()->user();
        $query = Customer::where('user_id', $user->id);

        if ($request->has('search') && $request->input('search') != '') {
            $query->where(function ($q) use ($request) {
                $q->where('customer_code', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('status', 'like', '%' . $request->input('search') . '%');
            });
        } else {
            $customer = [];
        }
        $customer = $query->get();

        $tariffgroupall = TariffCategory::where('user_id', $user->id)->get();
        $tariffgroup = $customer->load('tariffGroup');
        $companny = $customer->load('company');

        return view('pages.superadmin.report.customer', compact('customer', 'tariffgroup', 'tariffgroupall', 'companny'));
    }

    public function exportCustomer(Request $request)
    {
        $user = auth()->user();
        $query = Customer::where('user_id', $user->id);

        if ($request->has('search') && $request->input('search') != '') {
            $query->where(function ($q) use ($request) {
                $q->where('customer_code', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('status', 'like', '%' . $request->input('search') . '%');
            });
        }

        $customers = $query->get();

        return Excel::download(new CustomerExport($customers), 'customers.xlsx');
    }

    public function reportPayment(Request $request)
    {
        $userID = auth()->user()->id;
        $query = Payment::where('user_id', $userID);

        if ($request->has('search') && $request->input('search') != '') {
            $query->where(function ($q) use ($request) {
                $q->where('customer_code', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('status', 'like', '%' . $request->input('search') . '%');
            });
        }

        $payment = $query->get();
        return view('pages.superadmin.report.payment', compact('payment'));
    }

    public function exportPayment(Request $request)
    {
        $userID = auth()->user()->id;
        $query = Payment::where('user_id', $userID);

        if ($request->has('search') && $request->input('search') != '') {
            $query->where(function ($q) use ($request) {
                $q->where('customer_code', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('status', 'like', '%' . $request->input('search') . '%');
            });
        }


        if ($request->has('start_date')) {
            $query->where('payment_date', [
                $request->input('start_date'),
            ]);
        }

        $payment = $query->get();

        return Excel::download(new PaymentExport($payment), 'payment.xlsx');
    }

    public function filterDate(Request $request)
    {
        $userID = auth()->user()->id;
        $query = Payment::where('user_id', $userID);

        if ($request->has('start_date')) {
            $query->where('payment_date', [
                $request->input('start_date'),
            ]);
        }
        $payment = $query->get();
        return view('pages.superadmin.report.payment', compact('payment'));
    }
}

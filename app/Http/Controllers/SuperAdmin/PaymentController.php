<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $userID = auth()->user()->id;
        $pay = Payment::where('user_id', $userID)->get();
        return view('pages.superadmin.payment.index', compact('pay'));
    }
}

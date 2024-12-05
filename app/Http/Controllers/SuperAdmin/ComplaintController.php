<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $logUser = auth()->user()->id;
        $complaint =  Complaint::where('user_id', $logUser)->get();
        $user = Complaint::with('officers')->get(); // ambil function foreign key customer pada model record meter
        return view('pages.superadmin.complaint.index', compact('complaint', 'user'));
    }
}

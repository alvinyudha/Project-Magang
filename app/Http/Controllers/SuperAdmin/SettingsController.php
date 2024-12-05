<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $loguser = auth()->user();
        // $employee =  User::where('created_by', $loguser->id)->get();
        return view('pages.superadmin.profile.index',  compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'current_password' => '',
            'password' => '',
        ]);
        // Temukan pengguna yang akan diperbarui
        $user = User::findOrFail($id);
        // Memeriksa apakah password saat ini sesuai dengan yang ada di database
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->back()->with('failed', 'Password tidak sama.');
        }
        $user->password = Hash::make($validatedData['password']);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->update();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Profile anda berhasil di update');
    }
}

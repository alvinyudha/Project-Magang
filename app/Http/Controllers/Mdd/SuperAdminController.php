<?php

namespace App\Http\Controllers\Mdd;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Validasi dan pengambilan data
        $data = DB::table('users')
            ->join('company', 'company.id_company', '=', 'users.company_id')
            ->select('company.name AS company_name', 'users.*')
            ->join('roles', 'roles.id', '=', 'users.role')
            ->selectRaw('roles.name AS role_name')
            ->get();
        $company = DB::table('company')->get();
        $roles = DB::table('roles')->get();

        // Tampilkan view dengan data yang diperlukan
        return view('pages.mdd.add-superadmin.index', compact('data', 'company', 'roles'));
    }

    // Tambahkan pengguna baru
    public function storemin(Request $request)
    {
        // Validasi data yang diterima dari form
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_telp' => 'required',
            'address' => 'required',
            'company_id' => 'integer',
            'role' => 'integer'
        ]);

        // Buat pengguna baru
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->no_telp = $data['no_telp'];
        $user->address = $data['address'];
        $user->role = $data['role'];
        $user->company_id = $data['company_id'];
        $user->save();

        $role = Role::findById($data['role']);
        $user->assignRole($role);

        return redirect()->back()->with('success', 'Pengguna telah ditambahkan');
    }

    // Hapus pengguna
    public function deletemin($id)
    {
        $user = User::findOrFail($id);
        // Hapus semua relasi yang terkait dengan user
        if ($user) {

            Customer::where('user_id', $id)->delete();
            Employee::where('user_id', $id)->delete();

            $user->delete();
            return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Pengguna tidak ditemukan!');
        }
        // return redirect()->back()->with('success', 'Pengguna telah dihapus');
    }

    // Perbarui data pengguna
    public function updatemin(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'no_telp' => 'required',
            'address' => 'required',
            'company_id' => 'integer',
            'role' => 'integer'
        ]);

        // Temukan pengguna yang akan diperbarui
        $user = User::findOrFail($id);

        // Perbarui data pengguna
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->no_telp = $request->no_telp;
        $user->address = $request->address;
        $user->company_id = $request->company_id;
        $user->role = $request->role;

        $role = Role::findById($request->role);
        $user->syncRoles($role);

        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data pengguna telah diubah');
    }
}

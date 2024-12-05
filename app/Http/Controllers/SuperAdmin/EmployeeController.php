<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $employee =  User::where('created_by', $user->id)->get();
        return view('pages.superadmin.employee.index', compact('employee'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'address' => 'required',
            'no_telp' => 'required'
        ]);
        $employee = new User();

        $user = auth()->user();
        $company_id = $user->company_id;
        // dd($customer->group_id);
        $employee->company_id = $company_id;
        $employee->name = $validatedData['name'];
        $employee->username = $validatedData['username'];
        $employee->email = $validatedData['email'];
        $employee->password = Hash::make($validatedData['password']);
        $employee->address = $validatedData['address'];
        $employee->no_telp = $validatedData['no_telp'];
        $employee->created_by = auth()->user()->id;
        $employee->save();
        $role = Role::where('name', 'officer')->first();
        $employee->assignRole($role);
        return redirect()->back()->with('success', 'Employee created successfully');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'This Employee has been deleted');
    }

    public function deleteall()
    {
        $user = auth()->user();
        User::where('created_by', $user->id)->delete();
        return redirect()->back()->with('success', 'Semua data telah dihapus');
    }

    // Perbarui data pengguna
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'name' => '',
            'username' => '',
            'email' => '',
            'password' => '',
            'address' => '',
            'no_telp' => ''
        ]);
        // Temukan pengguna yang akan diperbarui
        $employee = User::findOrFail($id);
        // dd($customer->group_id);
        $employee->name = $validatedData['name'];
        $employee->username = $validatedData['username'];
        $employee->email = $validatedData['email'];
        $employee->password = Hash::make($validatedData['password']);
        $employee->address = $validatedData['address'];
        $employee->no_telp = $validatedData['no_telp'];
        $employee->update();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Employee has been updated');
    }
}

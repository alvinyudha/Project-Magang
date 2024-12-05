<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = [[
            'name' => 'John Doe',
            'username' => 'johndoe',
            'nip' => '12345678',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('11111'),
            'no_telp' => '123456789',
            'address' => 'Jl.jawa',
        ]];

        foreach ($employee as $employeedata) {
            Employee::create($employeedata);
        }
    }
}

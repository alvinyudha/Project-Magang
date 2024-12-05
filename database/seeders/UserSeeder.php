<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mdd = User::updateOrCreate([
            'name' => 'Mdd',
            'username' => 'Mdd',
            'email' => 'mdd@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
        ]);
        $mdd->assignRole('mdd');

        $superadmin = User::updateOrCreate([
            'name' => 'Superadmin',
            'username' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now()
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::updateOrCreate([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now()
        ]);
        $admin->assignRole('admin');

        $officer = User::updateOrCreate([
            'name' => 'Officer',
            'username' => 'Officer',
            'email' => 'officer@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now()
        ]);
        $officer->assignRole('officer');

        $user = User::updateOrCreate([
            'name' => 'User',
            'username' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now()
        ]);
        $user->assignRole('user');


        // DB::table('users')->insert([
        //     [
        //         'name' => 'Mdd',
        //         'email' => 'mdd@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'name' => 'Superadmin',
        //         'email' => 'superadmin@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'name' => 'Aadmin',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'name' => 'Officer',
        //         'email' => 'officer@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'name' => 'User',
        //         'email' => 'user@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'created_at' => now(),
        //     ],
        // ]);
    }
}
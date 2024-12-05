<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Buat beberapa contoh data pengguna
        $users = User::all();

        foreach ($users as $user) {
            // Seed complaint untuk setiap pengguna
            $complaint = [
                [
                    'user_id' => 6,
                    'officer' => 7,
                    'company_id' => 4,
                    'tittle' => $faker->sentence,
                    'describe' => $faker->sentence,
                    'photo' => $faker->imageUrl(),
                ]
            ];

            // Tambahkan lebih banyak contoh keluhan jika diperlukan
        }
        foreach ($complaint as $complaintData) {
            Complaint::create($complaintData);
        }
    }
}

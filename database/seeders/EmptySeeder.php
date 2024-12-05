<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\TariffGroup;
use App\Models\TariffLevel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmptySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the user table
        User::query()->delete();

        // Truncate the company table
        Company::query()->delete();

        // Truncate the tarif group table
        TariffGroup::query()->delete();

        // Truncate the tariff level table
        TariffLevel::query()->delete();
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TariffGroup;
use App\Models\TariffLevel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            RolePermissionSeeder::class,
            CompanySeeder::class,
            TariffGroupSeeder::class,
            TariffLevelSeeder::class,
            RecordMeterSeeder::class,
        ]);
    }
}

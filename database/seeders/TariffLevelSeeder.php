<?php

namespace Database\Seeders;

use App\Models\TariffGroup;
use App\Models\TariffLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TariffLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $group1A = TariffGroup::where('group_name', 'Tarif 1A')->first();
        $group1B = TariffGroup::where('group_name', 'Tarif 1B')->first();
        $group1C = TariffGroup::where('group_name', 'Tarif 1C')->first();

        $tariffLevels = [
            [
                'group_id' => $group1A->id,
                'level' => 'non-progressive_low',
                'tariff' => 800.00,
            ],
            [
                'group_id' => $group1B->id,
                'level' => '0-10',
                'tariff' => 0.00,
            ],
            [
                'group_id' => $group1B->id,
                'level' => '10-20',
                'tariff' => 600.00,
            ],
            [
                'group_id' => $group1B->id,
                'level' => '20-30',
                'tariff' => 1200.00,
            ],
            [
                'group_id' => $group1B->id,
                'level' => 'above_30',
                'tariff' => 2600.00,
            ],
            [
                'group_id' => $group1C->id,
                'level' => 'non-progressive_high',
                'tariff' => 15000.00,
            ],
        ];

        foreach ($tariffLevels as $tariffLevel) {
            TariffLevel::create($tariffLevel);
        }
    }
}

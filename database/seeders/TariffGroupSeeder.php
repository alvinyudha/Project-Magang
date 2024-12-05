<?php

namespace Database\Seeders;

use App\Models\TariffGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TariffGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tariff_groups = [
            [
                'group_name' => 'Tarif 1A',
                'desc' => 'Tarif non progresif untuk masyarakat tidak mampu, dikenakan rata tarif Rp 800 tiap pemakaiannya',
            ],
            [
                'group_name' => 'Tarif 1B',
                'desc' => 'Tarif berbeda ditiap habis pemakaiannya: {0-10 m3 Rp. 0, 10-20 m3 Rp. 600, 21-30 m3 Rp 1200, >30 m3 Rp 2600}',
            ],
            [
                'group_name' => 'Tarif 1C',
                'desc' => 'Tarif non progresif untuk pelabuhan udara dan laut dengan biaya rata Rp. 15000 per m3',
            ],
        ];

        foreach ($tariff_groups as $tariff_group) {
            TariffGroup::create($tariff_group);
        }
    }
}

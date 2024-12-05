<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecordMeter;
use App\Models\Customer;
use Faker\Factory as Faker;

class RecordMeterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua data customer yang ada
        $customers = Customer::all();
        $seederCount = 0;
        // Looping untuk setiap customer
        foreach ($customers as $customer) {
            // Hentikan loop setelah 10 seeder
            if ($seederCount >= 10) {
                break;
            }
            // Inisialisasi nilai awal last meter
            $lastMeter = $faker->randomFloat(2, 100, 1000);

            // Buat record meter untuk setiap bulan dari tahun 2023 sampai sekarang
            $startDate = new \DateTime('today');
            $endDate = new \DateTime();
            $interval = new \DateInterval('P1M');
            $period = new \DatePeriod($startDate, $interval, $endDate);

            foreach ($period as $date) {
                if ($seederCount >= 10) {
                    break 2;
                }
                // Tambahkan current meter secara acak dengan batasan berdasarkan last meter
                $currentMeter = $lastMeter + $faker->randomFloat(2, 1, 50);

                RecordMeter::create([
                    'id_customer' => $customer->id_customer,
                    'date' => $date->format('Y-m-d'),
                    'last_meter' => $lastMeter,
                    'current_meter' => $currentMeter,
                    'meter_photos' => $faker->imageUrl(),
                    'user_id' => 6,
                ]);

                // Update last meter untuk bulan berikutnya
                $lastMeter = $currentMeter;
                $seederCount++;
            }
        }
    }
}

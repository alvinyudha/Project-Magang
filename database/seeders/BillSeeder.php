<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\RecordMeter;
use Illuminate\Support\Facades\Http;
use Faker\Factory as Faker;


class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $seederCount = 0;

        foreach (range(1, 10) as $index) {
            if ($seederCount >= 10) {
                break;
            }

            $recordMeters = RecordMeter::all();
            // Tambahkan kurs Rupiah pada total_bill
            foreach ($recordMeters as $rm) {
                if ($seederCount >= 10) {
                    break 2;
                }
                $status = $faker->randomElement(['unpaid']);
                $usageAmount = $rm->current_meter - $rm->last_meter;
                $totalBill = $usageAmount * $faker->randomFloat(2, 1000, 9999);
                $totalBillFormatted =  round($totalBill, 2);
                Bill::create([
                    'customer_id' => $rm->id_customer,
                    'record_meter_id' => $rm->id,
                    'usage_amount' => $usageAmount,
                    'total_bill' => $totalBillFormatted,
                    'status' => $status,
                    'last_meter' => $rm->last_meter,
                    'current_meter' => $rm->current_meter,
                    'user_id' => 6,
                ]);
                $seederCount++;
            }
        }
    }
}

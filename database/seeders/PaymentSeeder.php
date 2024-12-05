<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\RecordMeter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $seederCount = 0;
        $bills = Bill::where('status', 'paid')->get();
        foreach ($bills as $b) {
            if ($seederCount >= 10) {
                break;
            }

            $status = $faker->randomElement(['paid']);
            $usageAmount = $b->current_meter - $b->last_meter;
            $totalBill = $usageAmount * $faker->randomFloat(2, 5, 10);
            $totalBillFormatted = "Rp." . number_format($totalBill, 2, ',', '.');
            Payment::create([
                'customer_id' => $b->id_customer,
                'name' => $b->name,
                'group_name' => 'Group A',
                'record_meter_id' => $b->id,
                'usage_amount' => $usageAmount,
                'total_bill' => $totalBillFormatted,
                'last_meter' => $b->last_meter,
                'current_meter' => $b->current_meter,
                'period' => $b->current_meter,
                'status' => $status,
                'customer_id' => 1,
                'record_meter_id' => 1,
                'last_meter' => 100,
                'current_meter' => 150,
                'period' => '2024-05',
                'usage_amount' => 50,
                'total_bill' => 500,
                'retribution' => 10,
                'fines' => 20,
                'total_payment' => 530,
                'status' => 'paid',
                'payment_date' => '2024-05-10',
                'user_id' => 6,
            ]);
            $seederCount++;
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $customers = Customer::all();
        $seederCount = 0;
        foreach ($customers as $customer) {
            if ($seederCount >= 10) {
                break;
            }
            Customer::create([
                'customer_code' => $faker->unique()->randomNumber(5),
                'group_id' => 1,
                'user_id' => 6,
                'company_id' => 4,
                'name' => $faker->name,
                'identity_card_number' => $faker->numerify('##########'),
                'address' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'location' => $faker->city,
                'land_status' => $faker->randomElement(['Owned', 'Rented']),
                'land_area' => $faker->numberBetween(100, 1000),
                'building_area' => $faker->numberBetween(50, 500),
                'meter_number' => $faker->numerify('#####'),
            ]);
        }
        $seederCount++;
    }
}

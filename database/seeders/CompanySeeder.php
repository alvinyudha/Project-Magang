<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Noxus INC',
                'address' => 'draven street',
                'email' => 'noxu@gmail.com',
                'fax' => '123456789',
                'pict' => 'nama_file_gambar.jpg',
                'no_telp' => '987654321',
            ],
            [
                'name' => '	Piltover INC',
                'address' => 'caitlyn street',
                'email' => 'piltover@perusahaan.com',
                'fax' => '123456789',
                'pict' => 'nama_file_gambar.jpg',
                'no_telp' => '987654321',
            ],
            [
                'name' => '	Demacia INC',
                'address' => 'galio street',
                'email' => 'demacia@gmail.com',
                'fax' => '123456789',
                'pict' => 'nama_file_gambar.jpg',
                'no_telp' => '987654321',
            ],
        ];
        foreach ($companies as $companyData) {
            Company::create($companyData);
        }
    }
}

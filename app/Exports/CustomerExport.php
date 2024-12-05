<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\TariffCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $customers;

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function collection()
    {
        return $this->customers;
    }

    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'Nama',
            'Perusahaan',
            'Kategori Tariff',
            'Alamat',
            'Nomor Telepon',
            'Lokasi',
            'Status',
        ];
    }
    public function map($customer): array
    {
        $company = Company::find($customer->company_id);
        $tariffGroup = TariffCategory::find($customer->group_id);
        return [
            $customer->customer_code,
            $customer->name,
            $company->name,
            $tariffGroup->group_name,
            $customer->address,
            $customer->no_telp,
            $customer->location,
            $customer->status,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}

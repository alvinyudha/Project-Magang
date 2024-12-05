<?php

namespace App\Exports;

use App\Models\TariffCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{

    protected $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function collection()
    {
        return $this->payment;
    }

    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'Nama',
            'Kategori Tariff',
            'Meteran Terakhir',
            'Meteran Saat Ini',
            'Jumlah Pemakaian',
            'Periode',
            'Total Tagihan',
            'Retribusi',
            'Denda',
            'Total Bayar',
            'Tanggal Pembayaran',
            'Status',
        ];
    }
    public function map($payment): array
    {
        return [
            $payment->customer_code,
            $payment->name,
            $payment->group_name,
            $payment->last_meter,
            $payment->current_meter,
            $payment->usage_amount,
            $payment->period,
            $payment->total_bill,
            $payment->retribution,
            $payment->fines,
            $payment->total_payment,
            $payment->payment_date,
            $payment->status,
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

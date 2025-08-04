<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Database\Eloquent\Builder;

// For events
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment; // For text alignment

class TransactionExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting, WithEvents
{
    protected $query;
    protected $totalRevenue; // Property to store total revenue

    public function __construct(Builder $query)
    {
        $this->query = $query;
        // Calculate total revenue once during construction to avoid re-calculating
        $this->totalRevenue = $this->query->sum('total');
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal',
            'Kode Transaksi',
            'Nama Pelanggan',
            'Jumlah Item',
            'Status Pembayaran',
            'Metode Pembayaran',
            'Subtotal (IDR)',
            'PPN (IDR)',
            'Total (IDR)',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            $transaction->created_at->format('d M Y H:i:s'),
            $transaction->code,
            $transaction->name,
            $transaction->items_sum_quantity,
            $transaction->payment_status,
            $transaction->payment_method,
            $transaction->subtotal,
            $transaction->ppn,
            $transaction->total,
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'I' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'J' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Gaya untuk baris header
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Gaya untuk semua data (opsional: menambahkan border)
        // Ini akan di-override sebagian oleh gaya total pendapatan di registerEvents
        $sheet->getStyle('A1:J' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFCCCCCC'],
                ],
            ],
        ]);

        // Mengatur tinggi baris header (opsional)
        $sheet->getRowDimension(1)->setRowHeight(25);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow(); // Dapatkan baris terakhir data

                // Tambahkan satu baris kosong untuk pemisah (opsional)
                // $lastRow++;
                // $sheet->setCellValue('A' . $lastRow, '');

                // Tambahkan baris total pendapatan setelah baris data terakhir
                $totalRow = $lastRow + 1;
                $sheet->setCellValue('A' . $totalRow, 'TOTAL PENDAPATAN:');
                $sheet->setCellValue('J' . $totalRow, $this->totalRevenue); // Kolom J untuk Total (IDR)

                // Gabungkan sel A sampai I untuk label "TOTAL PENDAPATAN"
                $sheet->mergeCells('A' . $totalRow . ':I' . $totalRow);

                // Styling untuk baris total pendapatan
                $sheet->getStyle('A' . $totalRow . ':J' . $totalRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['argb' => 'FF000000'], // Teks hitam
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFD9E1F2'], // Warna latar belakang abu-abu terang
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Atur perataan teks untuk sel "TOTAL PENDAPATAN" ke kanan
                $sheet->getStyle('A' . $totalRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                // Atur format angka untuk sel total pendapatan
                $sheet->getStyle('J' . $totalRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            },
        ];
    }
}

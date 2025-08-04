<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RiwayatPenjualan extends ChartWidget
{
    protected static ?string $heading = 'Riwayat Penjualan Harian';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // Ambil data transaksi dari 30 hari terakhir
        $transactions = Transaction::query()
            ->selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        // Inisialisasi data untuk 30 hari terakhir dengan nilai 0 jika tidak ada penjualan
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('d M');
            $data[$date] = 0;
        }

        // Isi data penjualan yang sebenarnya
        foreach ($transactions as $transaction) {
            $data[$transaction->date] = (float) $transaction->total_sales;
        }

        return [
            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Total Penjualan (IDR)',
                    'data' => array_values($data),
                    // Gradasi dari biru ke merah
                    'backgroundColor' => [
                        'rgba(3, 102, 214, 0.4)', // Biru muda
                        'rgba(255, 69, 0, 0.2)', // Merah transparan
                    ],
                    'borderColor' => '#0366D6', // Warna garis biru
                    'fill' => 'start', // Mengisi area di bawah garis dengan gradasi
                    'tension' => 0.4,
                ],
            ],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ]
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'elements' => [
                'point' => [
                    'radius' => 3,
                    'backgroundColor' => '#0366D6',
                    'borderColor' => '#FFFFFF',
                    'borderWidth' => 1,
                ]
            ]
        ];
    }
}

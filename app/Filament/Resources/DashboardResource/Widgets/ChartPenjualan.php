<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ChartPenjualan extends ChartWidget
{
    protected static ?string $heading = 'Penjualan Bulanan';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = '50%';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $months = collect([]);
        $sales = collect([]);

        // Loop through the last 6 months (including the current one)
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months->push($month->format('M Y')); // e.g., 'Jul 2025'

            $monthlySales = Transaction::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total'); // Make sure 'total' is the correct column for individual transaction amounts

            $sales->push($monthlySales);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan',
                    'data' => $sales->all(),
                    'borderColor' => '#4CAF50', // A nice green for the line
                    'backgroundColor' => [ // Define the gradient here
                        'rgba(76, 175, 80, 0.4)',  // Top part of the gradient (more opaque green)
                        'rgba(76, 175, 80, 0.0)'   // Bottom part of the gradient (transparent green)
                    ],
                    'fill' => 'start', // Make sure 'fill' is set to 'start' to apply the gradient from the line down
                    'tension' => 0.4, // Add some curve to the line for a smoother look
                ],
            ],
            'labels' => $months->all(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'drawOnChartArea' => false, // Hide horizontal grid lines
                    ],
                ],
                'x' => [
                    'grid' => [
                        'drawOnChartArea' => false, // Hide vertical grid lines
                    ],
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ]
            ],
            'elements' => [
                'point' => [
                    'radius' => 3, // Smaller points
                    'backgroundColor' => '#4CAF50', // Point color matches line
                    'borderColor' => '#FFFFFF', // White border for points
                    'borderWidth' => 1,
                ]
            ]
        ];
    }
}

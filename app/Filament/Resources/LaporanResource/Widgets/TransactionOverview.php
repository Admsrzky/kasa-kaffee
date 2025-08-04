<?php

namespace App\Filament\Resources\LaporanResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

class TransactionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Total Pendapatan Keseluruhan
        $totalRevenue = Transaction::sum('total');

        // Pendapatan Hari Ini
        $todayRevenue = Transaction::whereDate('created_at', Carbon::today())->sum('total');

        // Pendapatan Bulan Ini
        $thisMonthRevenue = Transaction::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');

        // Pendapatan Tahun Ini
        $thisYearRevenue = Transaction::whereYear('created_at', Carbon::now()->year)->sum('total');

        return [
            Stat::make('Total Pendapatan', 'Rp' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Jumlah pendapatan keseluruhan')
                ->descriptionIcon('heroicon-o-currency-dollar') // Icon dolar/mata uang
                ->color('success'), // Warna hijau untuk pendapatan positif

            Stat::make('Pendapatan Hari Ini', 'Rp' . number_format($todayRevenue, 0, ',', '.'))
                ->description('Total pendapatan hari ini')
                ->descriptionIcon('heroicon-o-calendar-days') // Icon kalender hari
                ->color($todayRevenue > 0 ? 'success' : 'gray'), // Hijau jika ada pendapatan, abu-abu jika nol

            Stat::make('Pendapatan Bulan Ini', 'Rp' . number_format($thisMonthRevenue, 0, ',', '.'))
                ->description('Total pendapatan bulan ini')
                ->descriptionIcon('heroicon-o-calendar') // Icon kalender
                ->color($thisMonthRevenue > 0 ? 'success' : 'gray'), // Hijau jika ada pendapatan, abu-abu jika nol

            Stat::make('Pendapatan Tahun Ini', 'Rp' . number_format($thisYearRevenue, 0, ',', '.'))
                ->description('Total pendapatan tahun ini')
                ->descriptionIcon('heroicon-o-chart-bar') // Icon grafik bar
                ->color($thisYearRevenue > 0 ? 'success' : 'gray'), // Hijau jika ada pendapatan, abu-abu jika nol
        ];
    }
}

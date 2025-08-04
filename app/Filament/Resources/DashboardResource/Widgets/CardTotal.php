<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class CardTotal extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Calculate daily income
        $todayIncome = Transaction::whereDate('created_at', Carbon::today())->sum('total');

        // Calculate weekly income (last 7 days)
        $startOfWeek = Carbon::today()->subDays(6); // Start of the last 7 days including today
        $endOfWeek = Carbon::today();
        $weeklyIncome = Transaction::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total');

        // Calculate total income (overall)
        $totalIncome = Transaction::sum('total');

        return [
            Stat::make('Total Transaksi', Transaction::count())
                ->description('Jumlah transaksi berhasil')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),

            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($todayIncome, 0, ',', '.'))
                ->description('Pendapatan transaksi hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Pendapatan Minggu Ini', 'Rp ' . number_format($weeklyIncome, 0, ',', '.'))
                ->description('Pendapatan transaksi 7 hari terakhir')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalIncome, 0, ',', '.'))
                ->description('Pendapatan keseluruhan transaksi')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('primary'), // Changed color to 'primary' for distinction
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Filament\Resources\TransactionItemsResource\Pages\ListTransactionItems;
use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Import for Export
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Exports\TransactionExport; // Pastikan Anda memiliki class ini

class LaporanResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Laporan Penjualan';

    protected static ?string $navigationGroup = 'Manajemen Transaksi';

    protected static ?string $pluralModelLabel = 'Laporan Penjualan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form tidak diperlukan untuk halaman laporan, jadi kita biarkan kosong.
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                // Eager load the 'items' relation and sum the quantities
                $query->withSum('items', 'quantity');
            })
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesan')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Transaksi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('items_sum_quantity')
                    ->label('Jumlah Item')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->searchable()
                    ->colors([
                        'success' => fn($state): bool => in_array($state, ['SUCCESS', 'PAID', 'SETTLED']),
                        'warning' => fn($state): bool => $state === 'PENDING',
                        'danger' => fn($state): bool => in_array($state, ['FAILED', 'EXPIRED']),
                    ]),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('ppn')
                    ->label('PPN')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),

            ])
            ->filters([
                Filter::make('bulan_tahun')
                    ->form([
                        Select::make('bulan')
                            ->options(function () {
                                return collect(range(1, 12))
                                    ->mapWithKeys(fn($month) => [$month => Carbon::create(null, $month, 1)->monthName])
                                    ->toArray();
                            })
                            ->label('Pilih Bulan'),
                        Select::make('tahun')
                            ->options(function () {
                                $currentYear = Carbon::now()->year;
                                return collect(range($currentYear - 5, $currentYear))
                                    ->mapWithKeys(fn($year) => [$year => $year])
                                    ->toArray();
                            })
                            ->label('Pilih Tahun'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['bulan'] ?? null,
                                fn(Builder $query, $bulan): Builder => $query->whereMonth('created_at', $bulan),
                            )
                            ->when(
                                $data['tahun'] ?? null,
                                fn(Builder $query, $tahun): Builder => $query->whereYear('created_at', $tahun),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['bulan'] ?? null) {
                            $indicators[] = 'Bulan: ' . Carbon::create(null, $data['bulan'], 1)->monthName;
                        }
                        if ($data['tahun'] ?? null) {
                            $indicators[] = 'Tahun: ' . $data['tahun'];
                        }
                        return $indicators;
                    }),
            ])
            ->headerActions([
                // Export Excel Action
                Action::make('export_excel')
                    ->label('Export Excel')
                    ->tooltip('Unduh laporan transaksi dalam format Excel (XLSX)')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (Table $table): BinaryFileResponse {
                        // Dapatkan query yang sudah difilter dari tabel Filament
                        $query = $table->getLivewire()->getFilteredTableQuery();

                        return \Maatwebsite\Excel\Facades\Excel::download(
                            new TransactionExport($query),
                            'laporan_penjualan_' . now()->format('Y-m-d_His') . '.xlsx'
                        );
                    }),
                // Export PDF Action
                Action::make('export_pdf')
                    ->label('Export PDF')
                    ->tooltip('Unduh laporan transaksi dalam format PDF')
                    ->color('danger')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (Table $table): BinaryFileResponse {
                        // Dapatkan query yang sudah difilter dari tabel Filament
                        $query = $table->getLivewire()->getFilteredTableQuery();

                        // Ambil data transaksi dengan relasi yang dibutuhkan untuk PDF
                        // Pastikan relasi 'items' di-eager load untuk menghitung quantity
                        $transactions = $query->with('items')->get();

                        // Hitung total pendapatan dari query yang sama
                        $totalGrandAmount = $query->sum('total'); // Menggunakan kolom 'total' dari Transaction

                        // Load view untuk PDF dan kirim data
                        // Pastikan Anda memiliki view 'exports.transactions_pdf'
                        $pdf = Pdf::loadView('exports.transactions_pdf', compact('transactions', 'totalGrandAmount'))
                            ->setPaper('a4', 'landscape');

                        // Simpan PDF ke file sementara
                        $tmpFile = tempnam(sys_get_temp_dir(), 'pdf');
                        file_put_contents($tmpFile, $pdf->output());

                        // Unduh file PDF sebagai BinaryFileResponse
                        return response()->download(
                            $tmpFile,
                            'laporan_penjualan_' . now()->format('Y-m-d_His') . '.pdf'
                        )->deleteFileAfterSend(true);
                    }),
            ])
            ->actions([
                Action::make('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(
                        fn(Transaction $record): string => static::getUrl('transaction-items.index', [
                            'parent' => $record->id,
                        ])
                    ),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
            'transaction-items.index' => ListTransactionItems::route('/{parent}/transaction'),

        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    // Menambahkan eager loading untuk relasi 'items' saat mengambil data untuk ekspor
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('items');
    }
}

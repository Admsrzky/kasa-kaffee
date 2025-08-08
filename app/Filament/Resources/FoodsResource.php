<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodsResource\Pages;
use App\Models\Foods;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class FoodsResource extends Resource
{
    protected static ?string $model = Foods::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Menu';

    protected static ?string $navigationGroup = 'Manajemen Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar Produk')
                    ->description('Detail umum tentang menu makanan atau minuman.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Menu')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        Select::make('categories_id')
                            ->label('Kategori')
                            ->required()
                            ->relationship('categories', 'name')
                            ->columnSpan(1),

                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('foods')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Harga & Promosi')
                    ->description('Atur harga dan opsi promosi untuk menu.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('price')
                            ->label('Harga Normal')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->reactive() // UBAH: Gunakan reactive agar lebih konsisten
                            ->columnSpan(1),

                        Toggle::make('is_promo')
                            ->label('Menu Promo?')
                            ->inline(false)
                            ->reactive() // Reactive untuk memicu perubahan saat di-toggle
                            ->columnSpan(1),

                        Select::make('percent')
                            ->label('Diskon (%)')
                            ->options([
                                10 => '10%',
                                25 => '25%',
                                35 => '35%',
                                50 => '50%',
                                75 => '75%',
                            ])
                            ->required(fn($get) => $get('is_promo'))
                            ->reactive()
                            ->hidden(fn($get) => !$get('is_promo'))
                            // UBAH: Ganti logika kompleks dengan panggilan fungsi sederhana
                            ->afterStateUpdated(fn($get, $set) => self::updatePriceAfterDiscount($get, $set))
                            ->columnSpan(1),

                        TextInput::make('price_afterdiscount')
                            ->label('Harga Setelah Diskon')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly()
                            ->hidden(fn($get) => !$get('is_promo'))
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->square()
                    ->defaultImageUrl(url('/images/placeholder.jpg')),

                TextColumn::make('name')
                    ->label('Nama Menu')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga Normal')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('price_afterdiscount')
                    ->label('Harga Diskon')
                    ->formatStateUsing(function ($state) {
                        // Jika $state (nilai dari price_afterdiscount) bernilai null, 0, atau kosong,
                        // maka tampilkan 'No diskon'.
                        if (blank($state) || $state <= 0) {
                            return 'No diskon';
                        }

                        // Jika ada nilainya, format sebagai mata uang Rupiah.
                        return Number::currency($state, 'IDR', 'id_ID');
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('percent')
                    ->label('Diskon')
                    ->suffix('%')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_promo')
                    ->label('Status Promo')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('categories')
                    ->label('Filter Kategori')
                    ->relationship('categories', 'name')
                    ->placeholder('Semua Kategori'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // TAMBAHKAN FUNGSI PRIVATE BARU INI DI DALAM CLASS
    private static function updatePriceAfterDiscount(callable $get, callable $set): void
    {
        $price = (float) $get('price');
        $percent = (int) $get('percent');

        // Hanya hitung jika toggle promo aktif dan ada nilai harga & persen
        if ($get('is_promo') && $price > 0 && $percent > 0) {
            $discountAmount = ($price * $percent) / 100;
            $set('price_afterdiscount', $price - $discountAmount);
        } else {
            // KUNCI PERBAIKAN: Set ke null jika tidak ada promo
            $set('price_afterdiscount', null);
        }
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFoods::route('/'),
            'create' => Pages\CreateFoods::route('/create'),
            'edit' => Pages\EditFoods::route('/{record}/edit'),
        ];
    }
}

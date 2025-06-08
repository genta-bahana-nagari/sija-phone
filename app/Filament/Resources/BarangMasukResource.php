<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangMasukResource\Pages;
use App\Filament\Resources\BarangMasukResource\RelationManagers;
use App\Models\BarangMasuk;
use App\Models\Brand;
use App\Models\Phone;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangMasukResource extends Resource
{
    protected static ?string $model = BarangMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationLabel = 'Barang Masuk';
    
    protected static ?string $pluralLabel = 'Daftar Barang Masuk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Pilih Brand
                Select::make('brand_id')
                    ->label('Brand')
                    ->options(Brand::all()->pluck('brand', 'id')) // Mengambil data brand dari model Brand
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Update phone_id berdasarkan brand yang dipilih
                        $set('phone_id', null); // Reset phone_id
                    }),

                // Pilih Phone berdasarkan brand yang dipilih
                Select::make('phone_id')
                    ->label('Phone')
                    ->options(function (callable $get) {
                        $brandId = $get('brand_id');
                        // Mengambil nama phone dan nama brand yang terkait
                        return Phone::where('brand_id', $brandId)
                            ->with('brand') // Eager load relasi brand
                            ->get()
                            ->mapWithKeys(function ($phone) {
                                // Menggunakan format "Brand - Phone" untuk pilihan
                                return [$phone->id => $phone->brand->brand . ' - ' . $phone->tipe]; // Menampilkan Brand - Tipe
                            });
                    })
                    ->required(),

                // Tanggal Masuk
                DatePicker::make('tgl_masuk')
                    ->label('Tanggal Masuk')
                    ->required(),

                // Jumlah Masuk
                TextInput::make('qty_masuk')
                    ->label('Jumlah Masuk')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(1),

                // Keterangan Masuk
                TextInput::make('keterangan_masuk')
                    ->label('Keterangan Masuk')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('phone.brand.brand') // Menampilkan nama brand
                    ->label('Brand')
                    ->sortable(),
                TextColumn::make('phone.tipe') // Menampilkan nama phone
                    ->label('Phone')
                    ->sortable(),
                TextColumn::make('tgl_masuk')
                    ->label('Tanggal Masuk')
                    ->sortable(),
                TextColumn::make('qty_masuk')
                    ->label('Jumlah Masuk')
                    ->sortable(),
                TextColumn::make('keterangan_masuk')
                    ->label('Keterangan')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Lihat Detail'),
                    Tables\Actions\EditAction::make()->label('Update Data'),
                    Tables\Actions\DeleteAction::make()->label('Hapus Data'),
                ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangMasuks::route('/'),
            'create' => Pages\CreateBarangMasuk::route('/create'),
            'edit' => Pages\EditBarangMasuk::route('/{record}/edit'),
        ];
    }
}

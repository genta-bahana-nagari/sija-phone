<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangKeluarResource\Pages;
use App\Filament\Resources\BarangKeluarResource\RelationManagers;
use App\Models\BarangKeluar;
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

class BarangKeluarResource extends Resource
{
    protected static ?string $model = BarangKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $navigationLabel = 'Barang Keluar';
    
    protected static ?string $pluralLabel = 'Daftar Barang Keluar';


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

                // Tanggal Keluar
                DatePicker::make('tgl_keluar')
                    ->label('Tanggal Keluar')
                    ->required()
                    ->minDate(fn ($get) => $get('tgl_masuk') ?: now()) // Mengambil tgl_masuk, jika belum diisi menggunakan nilai default (sekarang)
                    ->helperText('Tanggal keluar tidak bisa lebih awal dari tanggal masuk')
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        // Mengambil tgl_masuk setelah state diupdate
                        $tglMasuk = $get('tgl_masuk');
                        
                        // Validasi: Jika tgl_keluar lebih kecil dari tgl_masuk, reset tgl_keluar
                        if ($state && $tglMasuk && $state < $tglMasuk) {
                            $set('tgl_keluar', null); // Reset jika tidak valid
                        }
                    }),

                // Jumlah Keluar
                TextInput::make('qty_keluar')
                    ->label('Jumlah Keluar')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(1),

                // Keterangan Keluar
                TextInput::make('keterangan_keluar')
                    ->label('Keterangan Keluar')
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
                TextColumn::make('tgl_keluar')
                    ->label('Tanggal Keluar')
                    ->sortable(),
                TextColumn::make('qty_keluar')
                    ->label('Jumlah Keluar')
                    ->sortable(),
                TextColumn::make('keterangan_keluar')
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
            'index' => Pages\ListBarangKeluars::route('/'),
            'create' => Pages\CreateBarangKeluar::route('/create'),
            'edit' => Pages\EditBarangKeluar::route('/{record}/edit'),
        ];
    }
}

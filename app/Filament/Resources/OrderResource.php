<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Data Pesanan';
    
    protected static ?string $pluralLabel = 'Atur Pesanan';

    protected static function updateHargaTotal(callable $set, callable $get): void
    {
        $jumlah = $get('jumlah_order');
        $phoneId = $get('phone_id');
        $shippingTypeId = $get('shipping_type_id');

        $total = 0;

        if ($jumlah && $phoneId) {
            $phone = \App\Models\Phone::find($phoneId);
            if ($phone) {
                $total += $jumlah * $phone->harga;
            }
        }

        if ($shippingTypeId) {
            $shipping = \App\Models\ShippingType::find($shippingTypeId);
            if ($shipping) {
                $total += $shipping->ongkos;
            }
        }

        $set('harga_total', $total > 0 ? $total : null);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('phone_id')
                    ->label('Smartphone')
                    ->relationship('phone', 'tipe')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, callable $get) => static::updateHargaTotal($set, $get)),

                TextInput::make('jumlah_order')
                    ->label('Jumlah Order')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, callable $get) => static::updateHargaTotal($set, $get)),

                TextInput::make('harga_total')
                    ->label('Total Harga')
                    ->numeric()
                    ->prefix('Rp ')
                    ->disabled()
                    ->dehydrated(), // tetap dikirim ke backend meskipun disabled
                
                TextInput::make('alamat')
                    ->label('Alamat')
                    ->required(),

                TextInput::make('kontak')
                    ->label('Kontak Pembeli')
                    ->required(),

                Select::make('status_pesanan')
                    ->label('Status Pesanan')
                    ->options([
                        'pending' => 'Pending',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->default('pending'),

                Select::make('user_id')
                    ->label('User Buyer')
                    ->relationship('user', 'name') // adjust to your actual User name column
                    ->searchable()
                    ->required()
                    ->default(auth()->user()->id),

                Select::make('payment_type_id')
                    ->label('Metode Pembayaran')
                    ->relationship('paymentType', 'tipe_pembayaran') // adjust if needed
                    ->searchable()
                    ->required(),

                Select::make('shipping_type_id')
                    ->label('Jasa Kirim')
                    ->relationship('shippingType', 'tipe_pengiriman')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, callable $get) => static::updateHargaTotal($set, $get)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('phone.brand.brand')
                    ->label('Brand'),

                TextColumn::make('phone.tipe')
                    ->label('Smartphone'),

                TextColumn::make('user.name')
                    ->label('Buyer'),

                TextColumn::make('paymentType.tipe_pembayaran')
                    ->label('Metode Pembayaran'),

                TextColumn::make('shippingType.tipe_pengiriman')
                    ->label('Jasa Kirim'),

                TextColumn::make('jumlah_order')
                    ->label('Jumlah'),

                TextColumn::make('harga_total')
                    ->label('Total Harga')
                    ->money('IDR', locale: 'id'),
                
                TextColumn::make('shippingType.tipe_pengiriman')
                    ->label('Tipe Pengiriman'),

                BadgeColumn::make('status_pesanan')
                    ->label('Status')
                    ->colors([
                        'gray' => 'pending',
                        'warning' => 'diproses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ]),

                TextColumn::make('created_at')
                    ->label('Tanggal Order')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Lihat Detail'),
                    Tables\Actions\EditAction::make()->label('Ubah Data'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhoneResource\Pages;
use App\Filament\Resources\PhoneResource\RelationManagers;
use App\Models\Brand;
use App\Models\Phone;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class PhoneResource extends Resource
{
    protected static ?string $model = Phone::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationLabel = 'Data Smartphone';
    
    protected static ?string $pluralLabel = 'Daftar Smartphone';

    public static function canDelete(Model $record): bool
    {
        // Cek apakah hp ini memiliki relasi ke order
        return $record->orders()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section for Image Upload
                FileUpload::make('gambar')
                    ->label('Image')
                    ->image()
                    ->required()
                    ->helperText('Upload a phone image.'), // Set a file size limit for better user experience

                // Section for Phone Details
                TextInput::make('tipe')
                    ->label('Type')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter the phone type'),

                Textarea::make('deskripsi')
                    ->label('Descriptions')
                    ->required()
                    ->placeholder('Enter phone specifications'),

                // Stock Information Section
                TextInput::make('stok')
                    ->label('Stock')
                    ->disabled()
                    ->minValue(0)
                    ->helperText('Stok diatur lewat barang masuk'),

                Toggle::make('status_stok')
                    ->label('Stock Status')
                    ->disabled() // Disable the toggle since it's managed by the trigger
                    ->helperText('Stock status is automatically set based on stock quantity.'),

                // Price Information Section
                TextInput::make('harga')
                    ->label('Price (IDR)')
                    ->required()
                    ->minValue(0)
                    ->step(1000) // Set step for accurate input of IDR values (multiples of 1000)
                    ->placeholder('Enter the phone price'),

                // Select Brand Section
                Select::make('brand_id')
                    ->label('Brand')
                    ->options(Brand::all()->pluck('brand', 'id'))
                    ->searchable()
                    ->required()
                    ->placeholder('Select a brand'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                ImageColumn::make('gambar')
                    ->label('Image')
                    ->sortable(),
                
                TextColumn::make('brand.brand')
                    ->label('Brand')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('tipe')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('stok')
                    ->label('Stock')
                    ->sortable(),

                IconColumn::make('status_stok')
                    ->label('Status Stock')
                    ->alignCenter()
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('harga')
                    ->label('Price')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

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
                    BulkAction::make('deleteSelected')
                        ->label('Delete selected data')
                        ->action(function (Collection $records) {
                            $failed = [];

                            foreach ($records as $record) {
                                if ($record->orders()->exists()) {
                                    $failed[] = $record->nama;
                                    continue;
                                }

                                $record->delete();
                            }

                            if (!empty($failed)) {
                                Notification::make()
                                    ->title('Beberapa data tidak bisa dihapus')
                                    ->body('Data smartphone idak bisa dihapus karena masih ada order: ' . implode(', ', $failed))
                                    ->danger()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Data berhasil dihapus')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListPhones::route('/'),
            'create' => Pages\CreatePhone::route('/create'),
            'edit' => Pages\EditPhone::route('/{record}/edit'),
        ];
    }
}

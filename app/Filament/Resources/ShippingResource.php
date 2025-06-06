<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingResource\Pages;
use App\Filament\Resources\ShippingResource\RelationManagers;
use App\Models\ShippingType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class ShippingResource extends Resource
{
    protected static ?string $model = ShippingType::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Metode Pengiriman';
    
    protected static ?string $pluralLabel = 'Daftar Jasa Kirim';

    public static function canDelete(Model $record): bool
    {
        // Cek apakah metode ini memiliki relasi ke order
        return $record->orders()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tipe_pengiriman')
                    ->label('Nama Jasa Kirim')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipe_pengiriman')
                    ->label('Jasa Kirim')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->date(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('deleteSelected')
                        ->label('Hapus Terpilih')
                        ->action(function (Collection $records) {
                            $failed = [];

                            foreach ($records as $record) {
                                if ($record->phones()->exists()) {
                                    $failed[] = $record->nama;
                                    continue;
                                }

                                $record->delete();
                            }

                            if (!empty($failed)) {
                                Notification::make()
                                    ->title('Beberapa data tidak bisa dihapus')
                                    ->body('Jasa kirim berikut tidak bisa dihapus karena masih digunakan: ' . implode(', ', $failed))
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
            'index' => Pages\ListShippings::route('/'),
            'create' => Pages\CreateShipping::route('/create'),
            'edit' => Pages\EditShipping::route('/{record}/edit'),
        ];
    }
}

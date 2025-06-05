<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentTypesResource\Pages;
use App\Filament\Resources\PaymentTypesResource\RelationManagers;
use App\Models\PaymentTypes;
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

class PaymentTypesResource extends Resource
{
    protected static ?string $model = PaymentTypes::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Metode Pembayaran';
    
    protected static ?string $pluralLabel = 'Daftar Metode';

    public static function canDelete(Model $record): bool
    {
        // Cek apakah metode ini memiliki relasi ke order
        return $record->orders()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tipe_pembayaran')
                    ->label('Payment Methods')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipe_pembayaran')
                    ->label('Payment Methods')
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->label('Lihat Detail'),
                    Tables\Actions\EditAction::make()->label('Update Data'),
                    Tables\Actions\DeleteAction::make()->label('Hapus Data'),
                ])
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
                                    ->body('Metode pembayaran berikut tidak bisa dihapus karena masih digunakan: ' . implode(', ', $failed))
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
            'index' => Pages\ListPaymentTypes::route('/'),
            'create' => Pages\CreatePaymentTypes::route('/create'),
            'edit' => Pages\EditPaymentTypes::route('/{record}/edit'),
        ];
    }
}

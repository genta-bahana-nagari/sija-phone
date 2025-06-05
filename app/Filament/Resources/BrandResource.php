<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
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

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = 'Data Merk';
    
    protected static ?string $pluralLabel = 'Daftar Merk';

    public static function canDelete(Model $record): bool
    {
        // Cek apakah merk ini memiliki relasi ke phone (hp)
        return $record->phones()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('brand')
                    ->label('Brand Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand')
                    ->label('Brand Name')
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
                                    ->body('Data brand berikut tidak bisa dihapus karena memiliki relasi data smartphone: ' . implode(', ', $failed))
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}

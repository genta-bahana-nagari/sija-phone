<?php

namespace App\Filament\Resources\PaymentTypesResource\Pages;

use App\Filament\Resources\PaymentTypesResource;
use Filament\Actions;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPaymentTypes extends ListRecords
{
    protected static string $resource = PaymentTypesResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Metode Bayar'),
        ];
    }
}

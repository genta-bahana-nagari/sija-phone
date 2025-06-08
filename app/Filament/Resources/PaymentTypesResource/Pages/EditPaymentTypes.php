<?php

namespace App\Filament\Resources\PaymentTypesResource\Pages;

use App\Filament\Resources\PaymentTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentTypes extends EditRecord
{
    protected static string $resource = PaymentTypesResource::class;

// Menghapus delete Header saat edit

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

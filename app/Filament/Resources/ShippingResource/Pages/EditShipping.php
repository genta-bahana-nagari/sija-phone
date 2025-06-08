<?php

namespace App\Filament\Resources\ShippingResource\Pages;

use App\Filament\Resources\ShippingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShipping extends EditRecord
{
    protected static string $resource = ShippingResource::class;

// Menghapus delete Header saat edit

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

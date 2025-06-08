<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

// Menghapus delete Header saat edit

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

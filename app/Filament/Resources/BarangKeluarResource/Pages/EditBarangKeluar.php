<?php

namespace App\Filament\Resources\BarangKeluarResource\Pages;

use App\Filament\Resources\BarangKeluarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarangKeluar extends EditRecord
{
    protected static string $resource = BarangKeluarResource::class;

// Menghapus delete Header saat edit

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

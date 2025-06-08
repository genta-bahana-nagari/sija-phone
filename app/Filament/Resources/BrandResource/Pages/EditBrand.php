<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

// Menghapus delete Header saat edit

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

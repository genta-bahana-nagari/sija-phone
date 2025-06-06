<?php

namespace App\Filament\Resources\ShippingResource\Pages;

use App\Filament\Resources\ShippingResource;
use Filament\Actions;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShippings extends ListRecords
{
    protected static string $resource = ShippingResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Jasa Kirim'),
        ];
    }
}

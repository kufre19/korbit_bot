<?php

namespace App\Filament\Resources\LicenseOrderResource\Pages;

use App\Filament\Resources\LicenseOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLicenseOrders extends ListRecords
{
    protected static string $resource = LicenseOrderResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}

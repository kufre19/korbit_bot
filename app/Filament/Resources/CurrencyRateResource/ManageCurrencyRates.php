<?php

namespace App\Filament\Resources\CurrencyRateResource\Pages;

use App\Filament\Resources\CurrencyRateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCurrencyRates extends ManageRecords
{
    protected static string $resource = CurrencyRateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

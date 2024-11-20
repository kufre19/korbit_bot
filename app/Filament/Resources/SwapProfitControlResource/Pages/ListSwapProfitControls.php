<?php

namespace App\Filament\Resources\SwapProfitControlResource\Pages;

use App\Filament\Resources\SwapProfitControlResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSwapProfitControls extends ListRecords
{
    protected static string $resource = SwapProfitControlResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

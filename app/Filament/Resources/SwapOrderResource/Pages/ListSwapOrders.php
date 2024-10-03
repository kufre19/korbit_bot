<?php

namespace App\Filament\Resources\SwapOrderResource\Pages;

use App\Filament\Resources\SwapOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSwapOrders extends ListRecords
{
    protected static string $resource = SwapOrderResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}

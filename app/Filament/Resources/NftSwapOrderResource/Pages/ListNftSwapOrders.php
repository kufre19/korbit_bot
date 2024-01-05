<?php

namespace App\Filament\Resources\NftSwapOrderResource\Pages;

use App\Filament\Resources\NftSwapOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNftSwapOrders extends ListRecords
{
    protected static string $resource = NftSwapOrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

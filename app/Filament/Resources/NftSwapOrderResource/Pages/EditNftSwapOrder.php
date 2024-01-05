<?php

namespace App\Filament\Resources\NftSwapOrderResource\Pages;

use App\Filament\Resources\NftSwapOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNftSwapOrder extends EditRecord
{
    protected static string $resource = NftSwapOrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

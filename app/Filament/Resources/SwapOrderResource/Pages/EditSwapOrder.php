<?php

namespace App\Filament\Resources\SwapOrderResource\Pages;

use App\Filament\Resources\SwapOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSwapOrder extends EditRecord
{
    protected static string $resource = SwapOrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

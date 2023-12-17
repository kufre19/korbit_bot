<?php

namespace App\Filament\Resources\AcademyOrderResource\Pages;

use App\Filament\Resources\AcademyOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcademyOrders extends ListRecords
{
    protected static string $resource = AcademyOrderResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}

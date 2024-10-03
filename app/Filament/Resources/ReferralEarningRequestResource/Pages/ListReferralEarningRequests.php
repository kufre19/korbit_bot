<?php

namespace App\Filament\Resources\ReferralEarningRequestResource\Pages;

use App\Filament\Resources\ReferralEarningRequestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReferralEarningRequests extends ListRecords
{
    protected static string $resource = ReferralEarningRequestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

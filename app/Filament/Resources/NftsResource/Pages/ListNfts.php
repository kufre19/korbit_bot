<?php

namespace App\Filament\Resources\NftResource\Pages;

use App\Filament\Resources\NftsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNfts extends ListRecords
{
    protected static string $resource = NftsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

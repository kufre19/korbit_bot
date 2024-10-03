<?php

namespace App\Filament\Resources\NftResource\Pages;

use App\Filament\Resources\NftsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNft extends EditRecord
{
    protected static string $resource = NftsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

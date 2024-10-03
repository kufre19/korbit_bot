<?php

namespace App\Filament\Resources\NftResource\Pages;

use App\Filament\Resources\NftsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNft extends CreateRecord
{
    protected static string $resource = NftsResource::class;
}

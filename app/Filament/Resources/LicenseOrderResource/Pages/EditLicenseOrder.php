<?php

namespace App\Filament\Resources\LicenseOrderResource\Pages;

use App\Filament\Resources\LicenseOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLicenseOrder extends EditRecord
{
    protected static string $resource = LicenseOrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\AcademyOrderResource\Pages;

use App\Filament\Resources\AcademyOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAcademyOrder extends EditRecord
{
    protected static string $resource = AcademyOrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

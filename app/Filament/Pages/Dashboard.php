<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\SendMessageWidget;

class Dashboard extends BaseDashboard
{
    protected function getWidgets(): array
    {
        return [
            SendMessageWidget::class,
            // ... any other widgets you want to include
        ];
    }
}
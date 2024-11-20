<?php

namespace App\Filament\Resources;

use App\Models\SwapProfitControl;
use App\Filament\Resources\SwapProfitControlResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SwapProfitControlResource extends Resource
{
    protected static ?string $model = SwapProfitControl::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('maximun')
                    ->label('Maximum')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('minimum')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('divide_by')
                    ->label('Divide By')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('maximun')->label('Maximum'),
                Tables\Columns\TextColumn::make('minimum')->label('Minimum'),
                Tables\Columns\TextColumn::make('divide_by')->label('Divide By'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSwapProfitControls::route('/'),
            'edit' => Pages\EditSwapProfitControl::route('/{record}/edit'),
        ];
    }
}

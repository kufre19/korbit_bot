<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SwapOrderResource\Pages;
use App\Filament\Resources\SwapOrderResource\RelationManagers;
use App\Models\SwapOrder;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SwapOrderResource extends Resource
{
    protected static ?string $model = SwapOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('order_id')->required(),
            Forms\Components\BelongsToSelect::make('user_id')
                ->relationship('user', 'name'), // Assuming 'name' is a field in your User model
            Forms\Components\TextInput::make('from_asset')->required(),
            Forms\Components\TextInput::make('to_asset')->required(),
            Forms\Components\TextInput::make('amount')->numeric()->required(),
            Forms\Components\TextInput::make('amount_to_receive')->numeric(),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'completed' => 'Completed',
                    // Add other statuses as needed
                ])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id'),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('from_asset'),
                Tables\Columns\TextColumn::make('to_asset'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('amount_to_receive'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([
                // Define any filters if needed
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSwapOrders::route('/'),
            'create' => Pages\CreateSwapOrder::route('/create'),
            'edit' => Pages\EditSwapOrder::route('/{record}/edit'),
        ];
    }    
}

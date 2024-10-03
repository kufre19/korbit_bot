<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NftSwapOrderResource\Pages;
use App\Filament\Resources\NftSwapOrderResource\RelationManagers;
use App\Models\NftSwapOrder;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NftSwapOrderResource extends Resource
{
    protected static ?string $model = NftSwapOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Adjust field as needed
            Forms\Components\TextInput::make('order_id'),
            Forms\Components\TextInput::make('payable_amount')->numeric()->required(),
            Forms\Components\Select::make('status')->options([
                'pending' => 'Pending',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled'
            ]),
            Forms\Components\TextInput::make('wallet_address')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.tg_id'), // Adjust field as needed
            Tables\Columns\TextColumn::make('order_id'),
            Tables\Columns\TextColumn::make('payable_amount'), // Adjust field as needed
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('wallet_address'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNftSwapOrders::route('/'),
            'create' => Pages\CreateNftSwapOrder::route('/create'),
            'edit' => Pages\EditNftSwapOrder::route('/{record}/edit'),
        ];
    }   
}

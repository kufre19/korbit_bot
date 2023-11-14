<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionLogResource\Pages;
use App\Filament\Resources\TransactionLogResource\RelationManagers;
use App\Models\TransactionLog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionLogResource extends Resource
{
    protected static ?string $model = TransactionLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('from_asset')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('to_asset')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required(),
                Forms\Components\TextInput::make('received_amount')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email'),
                Tables\Columns\TextColumn::make('from_asset'),
                Tables\Columns\TextColumn::make('to_asset'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('received_amount'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // aad
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactionLogs::route('/'),
            'create' => Pages\CreateTransactionLog::route('/create'),
            'edit' => Pages\EditTransactionLog::route('/{record}/edit'),
        ];
    }    
}

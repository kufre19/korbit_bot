<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralEarningRequestResource\Pages;
use App\Models\ReferralEarningRequest;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReferralEarningRequestResource extends Resource
{
    protected static ?string $model = ReferralEarningRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('user_id')
                    ->relationship('user', 'name'), // Assuming 'name' is a field in your users table
                Forms\Components\TextInput::make('usdt_address')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User Name'),
                Tables\Columns\TextColumn::make('usdt_address')->label('USDT Address'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created At'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Updated At'),
            ])
            ->filters([
                // Add any filters if needed
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
            // Define any relations if needed
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReferralEarningRequests::route('/'),
            'create' => Pages\CreateReferralEarningRequest::route('/create'),
            'edit' => Pages\EditReferralEarningRequest::route('/{record}/edit'),
        ];
    }    
}

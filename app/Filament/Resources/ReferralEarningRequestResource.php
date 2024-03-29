<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralEarningRequestResource\Pages;
use App\Models\ReferralEarningRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Log;

class ReferralEarningRequestResource extends Resource
{
    protected static ?string $model = ReferralEarningRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {

        return $form
        
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required(),
                Forms\Components\TextInput::make('usdt_address')
                    ->disabled()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed'
                    ])
                    ->label('Status')
                    ->required(),
                Forms\Components\TextInput::make('referral_balance')
                    ->label('Update Referral Balance')
                    ->numeric()
                    ->dehydrated(false) // Prevents the field from being directly saved
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $record) {
                        if ($record && $record->user && $record->user->wallet) {
                            $record->user->wallet->update(['referral_balance' => $state]);
                        }
                    }),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.tg_id')->label('User TG ID'),
                Tables\Columns\TextColumn::make('usdt_address')->label('USDT Address'),
                // Tables\Columns\TextColumn::make('user.wallet.referral_balance')->label('Referral Balance'),
                Tables\Columns\TextColumn::make('status')->label('Request Status'),
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

    public static function loadUserWallet($referralEarningRequest)
    {
        if (!$referralEarningRequest->relationLoaded('user')) {
            $referralEarningRequest->load('user.wallet');
        }

        Log::debug("user wallet: " .$referralEarningRequest->toArray() );

        return $referralEarningRequest;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReferralEarningRequests::route('/'),
            // 'create' => Pages\CreateReferralEarningRequest::route('/create'),
            'edit' => Pages\EditReferralEarningRequest::route('/{record}/edit'),
        ];
    }

  
}

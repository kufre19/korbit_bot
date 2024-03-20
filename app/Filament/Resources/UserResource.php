<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Forms\Components\TextInput::make('tg_id')
            //     ->label('Telegram ID')
            //     ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255),
            // Forms\Components\TextInput::make('name')
            //     ->maxLength(255),
            Forms\Components\TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->visible(fn ($livewire) => $livewire instanceof CreateRecord),
            Forms\Components\Select::make('license')
                ->options([
                    'pending' => 'Pending',
                    'active' => 'Active',
                    'suspended' => 'Suspended',
                ]),
            Forms\Components\Select::make('academy_access')
                ->options([
                    'pending' => 'Pending',
                    'active' => 'Active',
                    'denied' => 'Denied',
                ]),
            Forms\Components\TextInput::make('referral_code')
                ->maxLength(255),
            // Forms\Components\BelongsToSelect::make('referrer_id')
            //     ->relationship('referrer', 'name'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('tg_id')
                    ->label('Telegram ID'),
                Tables\Columns\TextColumn::make('email'),
                // Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('license'),
                Tables\Columns\TextColumn::make('academy_access'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('referral_code'),
                Tables\Columns\TextColumn::make('referrer.name')
                    ->label('Referrer'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    
    public static function getQuery(): Builder
    {
        return parent::getQuery()->where('tg_id',"!=",null);
    }
}

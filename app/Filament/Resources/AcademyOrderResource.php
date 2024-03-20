<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademyOrderResource\Pages;
use App\Filament\Resources\AcademyOrderResource\RelationManagers;
use App\Models\AcademyOrder;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class AcademyOrderResource extends Resource
{
    protected static ?string $model = AcademyOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                CheckboxList::make('user_id')
                    ->relationship('user', 'name'), // Replace 'name' with the field you want to display from the User model
                Forms\Components\TextInput::make('order_id'),
                Forms\Components\TextInput::make('amount')
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        // Add other statuses as needed
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')->label('User'),
            Tables\Columns\TextColumn::make('order_id'),
            Tables\Columns\TextColumn::make('amount'),
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
            'index' => Pages\ListAcademyOrders::route('/'),
            'create' => Pages\CreateAcademyOrder::route('/create'),
            'edit' => Pages\EditAcademyOrder::route('/{record}/edit'),
        ];
    }    
}

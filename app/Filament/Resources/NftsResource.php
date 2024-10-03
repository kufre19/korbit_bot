<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NftResource\Pages;
use App\Filament\Resources\NftResource\RelationManagers;
use App\Models\Nft;
use App\Models\Nfts;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class NftsResource extends Resource
{
    protected static ?string $model = Nfts::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\FileUpload::make('image')
            ->label('Image')
            ->disk('public')
            ->directory('nfts') 
            ->visibility('public'),
            Forms\Components\TextInput::make('meta_data'),
            Forms\Components\TextInput::make('price')
            ->numeric(),
            Forms\Components\TextInput::make('blockchain'),
            Forms\Components\Textarea::make('description'),



        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\ImageColumn::make('image'),
            Tables\Columns\TextColumn::make('meta_data'),
            Tables\Columns\TextColumn::make('price'),
            Tables\Columns\TextColumn::make('blockchain'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNfts::route('/'),
            'create' => Pages\CreateNft::route('/create'),
            'edit' => Pages\EditNft::route('/{record}/edit'),
        ];
    }
}

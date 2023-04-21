<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerResource\Pages;
use App\Filament\Resources\OwnerResource\RelationManagers;
use App\Models\Owner;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class OwnerResource extends Resource {
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form( Form $form ): Form {
        return $form
        ->schema( [
            TextInput::make( 'name' )
            ->required()
            ->maxLength( length: 255 ),

            TextInput::make( 'email' )
            ->label( label: 'email address' )
            ->email()
            ->required()
            ->maxLength( length: 255 ),
            TextInput::make( 'phone' )
            ->label( label: 'phone number' )
            ->tel()
            ->required(),
        ] );
    }

    public static function table( Table $table ): Table {
        return $table
        ->columns( [
            TextColumn::make( name: 'name' )
            ->searchable(),
            TextColumn::make( name: 'email' )
            ->searchable(),
            TextColumn::make( name: 'phone' )
            ->searchable(),
        ] )
        ->filters( [
            //
        ] )
        ->actions( [
            Tables\Actions\EditAction::make(),
        ] )
        ->bulkActions( [
            Tables\Actions\DeleteBulkAction::make(),
        ] );
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListOwners::route( '/' ),
            'create' => Pages\CreateOwner::route( '/create' ),
            'edit' => Pages\EditOwner::route( '/{record}/edit' ),
        ];
    }

}
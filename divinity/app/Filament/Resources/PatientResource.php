<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Relations\Relation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use LengthException;

use function Termwind\render;

class PatientResource extends Resource {
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form( Form $form ): Form {
        return $form
        ->schema( [
            TextInput::make( 'name' )
            ->required()
            ->maxLength( length:255 ),
            Select::make( 'Type' )
            ->options( [
                'Dog' => 'Dog',
                'Cat' => 'Cat',
                'Rabbit' => 'Rabbit',
                'Chicken' => 'Chicken',
                'Cow' => 'Cow',
            ] )
            ->required(),
            DatePicker::make( 'date_of_birth' )
            ->required()
            ->maxDate( now() ),
            Select::make( name: 'owner_id' )
            ->relationship( relationshipName:'owner', titleColumnName: 'name' )
            ->searchable()
            ->preload()
            ->createOptionForm( [
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
            ] )
            ->required(),
        ] );
    }

    public static function table( Table $table ): Table {
        return $table
        ->columns( [

            TextColumn::make( name: 'name' )
            ->searchable(),
            TextColumn::make( name: 'type' ),
            TextColumn::make( name: 'date_of_birth' )
            ->date()
            ->sortable(),
            TextColumn::make( name: 'owner.name' )
            ->searchable(),
        ] )
        ->filters( [

            SelectFilter::make( 'type' )
            ->options( [
                'Dog' => 'Dog',
                'Cat' => 'Cat',
                'Rabbit' => 'Rabbit',
                'Chicken' => 'Chicken',
                'Cow' => 'Cow',
            ] )
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
            RelationManagers\TreatmentRelationManager::class,
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListPatients::route( '/' ),
            'create' => Pages\CreatePatient::route( '/create' ),
            'edit' => Pages\EditPatient::route( '/{record}/edit' ),
        ];
    }

}
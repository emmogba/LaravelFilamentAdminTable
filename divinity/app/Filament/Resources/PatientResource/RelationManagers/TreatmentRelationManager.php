<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;

class TreatmentRelationManager extends RelationManager {
    protected static string $relationship = 'treatment';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form( Form $form ): Form {
        return $form
        ->schema( [
            Forms\Components\TextInput::make( 'description' )
            ->required()
            ->maxLength( length: 255 )
            ->columnSpan( span:'full' ),

            TextArea::make( name:'notes' )
            ->maxLength( length: 65535 )
            ->columnSpan( span:'full' ),
            TextInput::make( name:'price' )
            ->numeric()
            ->prefix( label:'₦' )
            ->required()
            ->maxValue( value: 42949672.95 ),
        ] );
    }

    public static function table( Table $table ): Table {
        return $table
        ->columns( [
            Tables\Columns\TextColumn::make( 'description' ),
            Tables\Columns\TextColumn::make( 'price' )
            ->money( currency: 'NGN', shouldConvert: true )
            ->sortable(),
            Tables\Columns\TextColumn::make( 'created_at' )
            ->dateTime(),
            Tables\Columns\TextColumn::make( 'notes' )
        ] )
        ->filters( [
            //
        ] )
        ->headerActions( [
            Tables\Actions\CreateAction::make(),
        ] )
        ->actions( [
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ] )
        ->bulkActions( [
            Tables\Actions\DeleteBulkAction::make(),
        ] );
    }

}
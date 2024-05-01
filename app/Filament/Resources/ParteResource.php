<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParteResource\Pages;
use App\Filament\Resources\ParteResource\RelationManagers;
use App\Models\Parte;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParteResource extends Resource
{
    protected static ?string $model = Parte::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('numero')->label('Nº')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fecha')->date()->label('Fecha')->sortable()->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('cliente.nombre')->label('Cliente')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('maquina')->label('Máquina')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('averia')->label('Avería')->searchable()->sortable()->words(3),
                Tables\Columns\TextColumn::make('reparacion')->label('Reparación')->searchable()->sortable()->words(3),
                Tables\Columns\TextColumn::make('total')->label('Total')->money('EUR',locale:'es'),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Action::make('pdf')
                ->action(function(array $data,Parte $parte){
                     return $parte->generarPDF();
                })->button()
                ->icon('heroicon-m-document')
                ,
            ],position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPartes::route('/'),
            'create' => Pages\CreateParte::route('/create'),
            'edit' => Pages\EditParte::route('/{record}/edit'),
        ];
    }
}

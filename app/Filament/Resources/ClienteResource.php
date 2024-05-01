<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Filament\Resources\ClienteResource\RelationManagers\PartesRelationManager;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

   
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                ->label('Nombre y apellidos')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('dni_cif')
                ->label('DNI/CIF')
                ->required()
                ->maxLength(15),
                Forms\Components\TextInput::make('telefono')
                ->label('Teléfono/Móvil')
                ->required()
                ->maxLength(50),
                Forms\Components\TextInput::make('email')
                ->label('Correo electrónico')
                ->maxLength(255)
                ->rules(['required','email','max:255']),
                Forms\Components\Select::make('provincia')
                ->label('Provincia')
                ->options(array_combine(Cliente::ARRAY_PROVINCIAS,Cliente::ARRAY_PROVINCIAS))
                ->required(),
                Forms\Components\TextInput::make('poblacion')
                ->label('Población')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('direccion')
                ->label('Dirección')
                ->required()
                ->maxLength(255),    
                Forms\Components\TextInput::make('codigo_postal')
                ->label('Código Postal')
                ->rules(['required','numeric','digits:5']),
            ])
            ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('dni_cif')->label('DNI/CIF')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('telefono')->label('Móvil')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('direccion')->label('Dirección')
                ->description(fn (Cliente $record): string => $record->provincia.','.$record->poblacion.'('.$record->codigo_postal.')'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

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
            PartesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}

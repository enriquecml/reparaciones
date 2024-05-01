<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use App\Models\Cliente;
use App\Models\Parte;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartesRelationManager extends RelationManager
{
    protected static string $relationship = 'partes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero')
                    ->label('Número')
                    ->required()
                    ->maxLength(255)
                    ->default(Parte::max('numero')+1),
                DatePicker::make('fecha')->default(Carbon::now())->required(),
                Section::make('Descripción')
                ->schema([
                    TextInput::make('maquina')->label('Máquina')->required(),
                    Textarea::make('averia')->label('Avería')->required(),
                    Textarea::make('reparacion')->label('Reparación'),
                ]
                ),
                Section::make('Gastos')
                ->columns(5)
                ->schema([
                    TextInput::make('mano_obra')->label('Mano de obra')->numeric()->inputMode('decimal'),
                    TextInput::make('desplazamiento')->numeric()->inputMode('decimal'),
                    TextInput::make('portes')->numeric()->inputMode('decimal'),
                    TextInput::make('materiales')->numeric()->inputMode('decimal'),
                    TextInput::make('iva')->label('% IVA')->numeric()->inputMode('decimal')->default(21),
                ]
                ),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('numero')
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
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

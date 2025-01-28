<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrarResource\Pages;
use App\Filament\Resources\RegistrarResource\RelationManagers;
use App\Models\Registrar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class RegistrarResource extends Resource
{
    protected static ?string $model = Registrar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Registrar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Personal')
                    ->description('Ingrese los datos del registrante')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('nombres')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function ($state) {
                                // dd($state);
                                // Convierte la primera letra a mayúscula y el resto a minúscula
                                return ucfirst(strtolower($state));
                            }),
                        Forms\Components\TextInput::make('apellidos')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('centro_infantil')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Grid::make(3)  // Divide en 3 columnas iguales
                            ->schema([
                                Forms\Components\TextInput::make('persona_autorizada1')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Persona Autorizada'),

                                Forms\Components\TextInput::make('parentesco1')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('celular1')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(3)  // Divide en 3 columnas iguales
                            ->schema([
                                Forms\Components\TextInput::make('persona_autorizada2')

                                    ->maxLength(255)
                                    ->label('Segunda Persona Autorizada'),

                                Forms\Components\TextInput::make('parentesco2')

                                    ->maxLength(255),

                                Forms\Components\TextInput::make('celular2')

                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(3)  // Divide en 3 columnas iguales
                            ->schema([
                                Forms\Components\TextInput::make('persona_autorizada3')

                                    ->maxLength(255)
                                    ->label('Tercera Persona Autorizada'),

                                Forms\Components\TextInput::make('parentesco3')

                                    ->maxLength(255),

                                Forms\Components\TextInput::make('celular3')

                                    ->maxLength(255),
                            ]),
                        Forms\Components\FileUpload::make('fotografia')
                            // ->required()
                            ->directory('fotografias') // Subirá las imágenes a storage/app/public/fotografias
                            ->preserveFilenames(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('centro_infantil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('persona_autorizada1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('persona_autorizada2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('persona_autorizada3')
                    ->searchable(),

                Tables\Columns\TextColumn::make('parentesco')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('fotografia')
                    ->label('Fotografía')
                    ->circular()
                    ->width(50)
                    ->height(50),
                Tables\Columns\TextColumn::make('celular')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('generarCredencial')
                    ->label('Generar Credencial PDF')
                    ->url(fn($record) => route('generar-credencial', ['id' => $record->id]))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success'),
            ])
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
            'index' => Pages\ListRegistrars::route('/'),
            'create' => Pages\CreateRegistrar::route('/create'),
            'edit' => Pages\EditRegistrar::route('/{record}/edit'),
        ];
    }
}

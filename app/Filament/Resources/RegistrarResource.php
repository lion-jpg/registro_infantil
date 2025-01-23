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

class RegistrarResource extends Resource
{
    protected static ?string $model = Registrar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Registrar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\TextInput::make('nombres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('centro_infantil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('personas_autorizadas')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('parentesco')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('fotografia')
                    ->required(),
                Forms\Components\TextInput::make('celular')
                    ->required()
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('personas _autorizadas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parentesco')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fotografia')
                ->label('Fotografía')
                ->formatStateUsing(function ($state) {
                    return "<img src='" . asset('storage/' . $state) . "' alt='Fotografía' style='border-radius: 50%; width: 50px; height: 50px; object-fit: cover;'>";
                })
                ->html(), // Esta opción es importante para renderizar el HTML,
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
                ->url(fn ($record) => route('generar-credencial', ['id' => $record->id]))
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

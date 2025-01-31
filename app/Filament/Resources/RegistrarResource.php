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
use Filament\Forms\Components\Select;

// use Filament\Tables\Actions\Action;

class RegistrarResource extends Resource
{
    protected static ?string $model = Registrar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Registrar';
    protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationBadgeTooltip = 'The number of users';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Personal')
                    ->description('Ingrese los datos del registrante')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('nombres')
                            ->placeholder('Nombre del niño')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(function ($state) {
                                return strtoupper($state); // Convierte todo el texto a mayúsculas
                            }),
                        Forms\Components\TextInput::make('apellidos')
                            ->placeholder('Apellidos del niño')
                            ->required()
                            ->maxLength(255),
                        // Forms\Components\TextInput::make('centro_infantil')
                        //     ->required()
                        //     ->maxLength(255),
                        Forms\Components\Select::make('centro_infantil')
                            ->label('Centro Infantil')
                            ->required()
                            ->options([
                                'ARCO IRIS' => 'Arco Iris',
                                'MARIA AUXILIADORA' => 'Maria Auxiliadora',
                                'POLICIA BOLIVIANA EPI 3' => 'Policia Boliviana EPI 3',
                                'INSTITUTO TECNOLOGICO DON BOSQUITO' => 'Instituto Tércnologico Don Bosquito',
                                'SANTIAGO II-1' => 'Santiago II-1',
                                'VILLA BOLIVAR D (COMUNITARIO BOLIVAR)' => 'Villa Bolivar D (Comunitario Bolivar)',
                                'HORIZONTES II' => 'Horizontes II',
                                '21 DE DICIEMBRE' => '21 de Diciembre',
                                'SAN FRANCISCO DE ASIS ' => 'San Fransisco de Asis',
                                'PALLIRI' => 'Palliri',
                                'HORIZONTES I' => 'Horizontes I',
                                'APOSTOL SANTIAGO' => 'Apostol Santiago',
                                'BEATA PIEDAD DE LA CRUZ' => 'Beata Piedad de La Cruz',
                                'CAMPANITAS' => 'Campanitas',
                                'SAGRADO CORAZON DE JESÚS' => 'Sagrado corazon de Jesús',
                                'SAN MIGUEL' => 'San Miguel',
                                'SAN URBANO' => 'San Urbano',
                                'VILLA ALEMANIA' => 'Villa Alemania',
                                'VIRGEN DE LA FUENSANTA' => 'Virgen De La Fuensanta',
                                'SAN PEDRO' => 'San Pedro',
                                'NUEVA MARKA' => 'Nueva Marka',
                                'JISK´A UTITA-GESTION RENUEVA' => 'Jisk´a Utita-Gestion Renueva',
                                '16 DE FEBRERO' => '16 de Febrero',
                                'TUPAC KATARI "CAPULLITOS"' => 'Tupac Katari "Capullitos"',
                                'RINCONCITO' => 'Rinconcito',
                                'NUEVA ASUNCION' => 'Nueva Asuncion',
                                'HUAYNA POTOSI CARITAS ALEGRES' => 'Huayna Potosi Caritas Alegres',
                                'MENESIANO YURIÑANI' => 'Menesiano Yuriñani',
                                'VIRGEN NIÑA' => 'Virge de la Niña',
                                'LOS ANGELES FUTECRA' => 'Los Angeles Futecra',
                                'FERROPETROL' => 'Ferropetrol',
                                '14 DE SEPTIEMBRE VENTILLA' => '14 de Septiembre',
                                '16 DE NOBIEMBRE' => '16 de Nobiembre',
                                'POR UN MUNDO MEJOR' => 'Por Un Mundo Mejor',
                                'ATIPIRIS' => 'Atipiris',
                                '14 DE SEPTIEMBRE B' => '14 de Septiembre B',
                                'SAN MARTIN' => ' San Martin',
                                'BAUTISTA SAAVEDRA' => 'Bautista Saavedra',
                                'CENTRO SOCIAL S.O.S.' => 'Centro Social S.O.S.',
                                'SANTA ROSA DE LIMA' => 'Santa Rosa de Lima',
                                'ESPECIAL MURURATA' => 'Especial Mururata',
                                'CRISTO DEL CONSUELO' => 'Cristo Del Consuelo',
                                'VILLA INGENIO' => 'Villa Ingenio',

                            ])
                            ->native(false),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nombre_padre')
                                    ->placeholder('Nombre Completo')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Padre'),
                                Forms\Components\TextInput::make('celular_p')
                                    ->label('Celular del Padre')
                                    ->numeric()
                                    ->tel()
                                    ->minLength(8)
                                    ->maxLength(8)
                                    ->required()
                                    ->inputMode('numeric')
                                    ->rules(['regex:/^[0-9]{8}$/']),

                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nombre_madre')
                                    ->placeholder('Nombre Completo')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Madre'),
                                Forms\Components\TextInput::make('celular_m')
                                    ->label('Celular de la Madre')
                                    ->numeric()
                                    ->tel()
                                    ->minLength(8)
                                    ->maxLength(8)
                                    ->required()
                                    ->inputMode('numeric')
                                    ->rules(['regex:/^[0-9]{8}$/']),

                            ]),
                        Forms\Components\TextInput::make('direccion')
                            ->label('Direccion')
                            ->required(),
                        Forms\Components\Grid::make(3)  // Divide en 3 columnas iguales
                            ->schema([
                                Forms\Components\TextInput::make('persona_autorizada1')
                                    ->placeholder('Nombre Completo')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Persona Autorizada 1'),
                                Forms\Components\Select::make('parentesco1')
                                    ->required()
                                    ->options([
                                        'Padre' => 'Padre',
                                        'Madre' => 'Madre',
                                        'Tio' => 'Tio',
                                        'Tia' => 'Tia',
                                        'Hermano' => 'Hermano',
                                        'Hermana' => 'Hermana',
                                        'Abuelo' => 'Abuelo',
                                        'Abuela' => 'Abuela',
                                    ])
                                    ->native(false),

                                Forms\Components\TextInput::make('celular1')
                                    ->numeric()
                                    ->tel()
                                    ->minLength(8)
                                    ->maxLength(8)
                                    // ->required()
                                    ->inputMode('numeric')
                                    ->rules(['regex:/^[0-9]{8}$/']),
                            ]),
                        Forms\Components\Grid::make(3)  // Divide en 3 columnas iguales
                            ->schema([
                                Forms\Components\TextInput::make('persona_autorizada2')

                                    ->maxLength(255)
                                    ->label('Segunda Persona Autorizada')
                                    ->placeholder('Nombre Completo'),
                                Forms\Components\Select::make('parentesco2')
                                    ->options([
                                        'Padre' => 'Padre',
                                        'Madre' => 'Madre',
                                        'Tio' => 'Tio',
                                        'Tia' => 'Tia',
                                        'Hermano' => 'Hermano',
                                        'Hermana' => 'Hermana',
                                        'Abuelo' => 'Abuelo',
                                        'Abuela' => 'Abuela',
                                    ])
                                    ->native(false),

                                Forms\Components\TextInput::make('celular2')
                                    ->numeric()
                                    ->tel()
                                    ->minLength(8)
                                    ->maxLength(8)
                                    // ->required()
                                    ->inputMode('numeric')
                                    ->rules(['regex:/^[0-9]{8}$/']),
                            ]),
                        Forms\Components\Grid::make(3)  // Divide en 3 columnas iguales
                            ->schema([
                                Forms\Components\TextInput::make('persona_autorizada3')
                                    ->placeholder('Nombre Completo')
                                    ->maxLength(255)
                                    ->label('Tercera Persona Autorizada'),
                                Forms\Components\Select::make('parentesco3')
                                    ->options([
                                        'Padre' => 'Padre',
                                        'Madre' => 'Madre',
                                        'Tio' => 'Tio',
                                        'Tia' => 'Tia',
                                        'Hermano' => 'Hermano',
                                        'Hermana' => 'Hermana',
                                        'Abuelo' => 'Abuelo',
                                        'Abuela' => 'Abuela',
                                    ])
                                    ->native(false),

                                Forms\Components\TextInput::make('celular3')
                                    ->numeric()
                                    ->tel()
                                    ->minLength(8)
                                    ->maxLength(8)
                                    // ->required()
                                    ->inputMode('numeric')
                                    ->rules(['regex:/^[0-9]{8}$/']),
                            ]),
                        Forms\Components\FileUpload::make('fotografia')
                            ->required()
                            ->disk('public')
                            ->preserveFilenames(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombres')
                    ->label('Nombres Niño/a')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->label('Apellidos Niño/a')
                    ->searchable(),
                Tables\Columns\TextColumn::make('centro_infantil')
                    ->label('Centro Infantil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_padre')
                    // ->reactive()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Nombre del Padre')
                    ->searchable() // Mantiene la columna visible por defecto
                ,
                Tables\Columns\TextColumn::make('celular_p')
                    ->label('Celular del Padre')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                // ->toggledHiddenByDefault(false) // Mantiene la columna visible por defecto
                ,
                Tables\Columns\TextColumn::make('nombre_madre')
                    ->label('Nombre de la Madre')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('celular_m')
                    ->label('Celular de la Madre')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('persona_autorizada1')
                    ->label('Persona Autorizada 1')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('parentesco1')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('celular1')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('persona_autorizada2')
                    ->label('Persona Autorizada 2')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('parentesco2')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('celular2')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('persona_autorizada3')
                    ->label('Persona Autorizada 3')

                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('parentesco3')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('celular3')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('fotografia')
                    ->label('Fotografía')
                    ->circular()
                    ->width(50)
                    ->height(50)
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->toggleColumnsTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Lista de Formulario'),
            )
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('generarCredencial')
                    ->button()
                    ->label('Descargar Credencial')
                    ->url(fn($record) => route('generar-credencial', ['id' => $record->id]))
                    // ->icon('heroicon-o-arrow-down-tray')
                    ->color('info')
                    ->outlined(),

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

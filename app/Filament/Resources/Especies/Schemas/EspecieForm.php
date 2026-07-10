<?php

namespace App\Filament\Resources\Especies\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Tabs as ComponentsTabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\Alignment;

class EspecieForm
{
    public static function configure($form) // Ajustado al estándar nativo de Filament Form / Schema
    {
        return $form
            ->schema([
                ComponentsTabs::make('Ficha Técnica de la Especie')
                    ->tabs([
                        // PESTAÑA 1: DATOS GENERALES
                        Tab::make('Información Básica')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                FileUpload::make('fotografia') // Coincide con $especie->imagen en tu Blade
                                    ->label('Fotografía Principal')->avatar()
                                    ->disk('imagenes')
                                    ->directory('especies')
                                    ->image()->imageEditor()
                                    ->required()
                                    ->columnSpanFull()->alignCenter(),
                                ComponentsGrid::make(2)->schema([
                                    TextInput::make('nombre')
                                        ->label('Nombre Común')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('cientifico')
                                        ->label('Nombre Científico')
                                        ->required()
                                        ->maxLength(255),
                                ]),


                            ]),

                        // PESTAÑA 2: DATOS RÁPIDOS (TABLA)
                        Tab::make('Datos Rápidos')
                            ->icon('heroicon-o-table-cells')
                            ->schema([
                                Repeater::make('datos')
                                    ->label('Métricas / Datos de Cabecera')
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Etiqueta (ej: Familia, Altura)')
                                            ->required(),
                                        TextInput::make('valor')
                                            ->label('Valor (ej: Magnoliaceae, 15 m)')
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Añadir Dato Rápido')
                                    ->columnSpanFull(),
                            ]),

                        // PESTAÑA 3: CARACTERÍSTICAS (NUEVO)
                        Tab::make('Características Detalladas')
                            ->icon('heroicon-o-squares-plus')
                            ->schema([
                                Repeater::make('caracteristicas') // Coincide con $especie->caracteristicas en tu Blade
                                    ->label('Bloques de Características')
                                    ->schema([
                                        Select::make('icono')
                                            ->label('Icono / Emoji')
                                            ->options([
                                                '🌿' => '🌿 Hoja / Planta',
                                                '🌸' => '🌸 Flor',
                                                '💧' => '💧 Agua / Riego',
                                                '✂️' => '✂️ Cuidados / Poda',
                                                '🌱' => '🌱 Raíz / Brote',
                                                '🌎' => '🌎 Planeta / Distribución',
                                                '📏' => '📏 Regla / Altura',
                                                '🌰' => '🌰 Fruto / Semilla',
                                                '🪴' => '🪴 Suelo',
                                                '☀️' => '☀️ Exposición solar'
                                            ])
                                            ->default('🌿')
                                            ->required(),
                                        TextInput::make('titulo')
                                            ->label('Título de la Característica')
                                            ->placeholder('Ej: Follaje')
                                            ->required(),
                                        TextInput::make('texto')
                                            ->label('Descripción Corta')
                                            ->placeholder('Ej: Hojas grandes y coriáceas...')
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2)
                                    ->grid(2) // Hace que en el panel administrativo se organicen en 2 columnas paralelas
                                    ->addActionLabel('Añadir Característica')
                                    ->columnSpanFull(),
                            ]),

                        // PESTAÑA 4: CONTENIDO EDITORIAL Y CURIOSIDADES
                        Tab::make('Secciones de Texto')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Repeater::make('contenido')
                                    ->label('Bloques de Contenido General')
                                    ->schema([
                                        TinyEditor::make('contenido')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsVisibility('public')
                                            ->fileAttachmentsDirectory('uploads')
                                            ->profile('full') // Configuración intermedia para agilizar la carga
                                            ->columnSpanFull()
                                            ->required(),
                                    ])
                                    ->addActionLabel('Añadir Bloque Editorial')
                                    ->columnSpanFull(),

                                TinyEditor::make('sabias')
                                    ->label('¿Sabías que...? (Curiosidad Destacada)')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('uploads')
                                    ->profile('full')
                                    ->columnSpanFull()
                                    ->required(),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }
}

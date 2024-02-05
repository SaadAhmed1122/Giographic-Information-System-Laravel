<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoadResource\Pages;
use App\Filament\Resources\RoadResource\RelationManagers;
use App\Models\Road;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;

class RoadResource extends Resource
{
    protected static ?string $model = Road::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('RoadName')->label('Name'),
                TextInput::make('RoadType')->label('Type'),
                TextInput::make('StartLocation')->label('Start Location'),
                TextInput::make('EndLocation')->label('End Location'),


                Forms\Components\TextInput::make('lat')
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $set('location', [
                            'lat' => floatVal($state),
                            'lng' => floatVal($get('lng')),
                        ]);
                    })
                    ->lazy()
                    ->maxLength(32),
                Forms\Components\TextInput::make('lng')
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $set('location', [
                            'lat' => floatval($get('lat')),
                            'lng' => floatVal($state),
                        ]);
                    })
                    ->lazy()
                    ->maxLength(32),

                Map::make('location')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $set('lat', $state['lat']);
                        $set('lng', $state['lng']);
                    })
                    ->drawingControl()
                    // ->defaultLocation([39.526610, -107.727261])
                    ->mapControls([
                        'zoomControl' => true,
                    ])
                    ->debug()
                    // ->geolocateOnLoad(true, false)
                    ->clickable()
                    // ->geoJson('./resources/shapfiles/Strade.geojson')
                    ->layers([
                        'https://github.com/SaadAhmed1122/Strade_data/blob/main/Strade.kml'
                    ])
                    // ->geoJsonContainsField('Strade')
                    ->autocomplete('formatted_address')
                    // ->autocompleteReverse()
                    // ->reverseGeocode([
                    //     'city' => '%L',
                    //     'zip' => '%z',
                    //     'state' => '%A1',
                    //     'street' => '%n %S',
                    // ])
                    ->geolocate(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRoads::route('/'),
            'create' => Pages\CreateRoad::route('/create'),
            'edit' => Pages\EditRoad::route('/{record}/edit'),
        ];
    }
}

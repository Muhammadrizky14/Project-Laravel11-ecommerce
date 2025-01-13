<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingResource\Pages;
use App\Models\Shipping;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->label('Province')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('city_id', null))
                    ->options(function () {
                        $rajaOngkir = app(RajaOngkirService::class);
                        return collect($rajaOngkir->getProvinces())
                            ->pluck('province', 'province_id');
                    }),
                Forms\Components\Select::make('city_id')
                    ->label('City')
                    ->required()
                    ->options(function (callable $get) {
                        if (!$get('province_id')) {
                            return [];
                        }
                        $rajaOngkir = app(RajaOngkirService::class);
                        return collect($rajaOngkir->getCities($get('province_id')))
                            ->pluck('city_name', 'city_id');
                    }),
                Forms\Components\Select::make('courier')
                    ->label('Courier')
                    ->required()
                    ->options([
                        'jne' => 'JNE',
                        'pos' => 'POS Indonesia',
                        'tiki' => 'TIKI'
                    ]),
                Forms\Components\TextInput::make('base_cost')
                    ->label('Base Cost')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('city')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('courier')->sortable(),
                Tables\Columns\TextColumn::make('base_cost')
                    ->money('idr')
                    ->sortable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShippings::route('/'),
            'create' => Pages\CreateShipping::route('/create'),
            'edit' => Pages\EditShipping::route('/{record}/edit'),
        ];
    }
}


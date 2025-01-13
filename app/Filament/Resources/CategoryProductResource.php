<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryProductResource\Pages;
use App\Models\CategoryProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryProductResource extends Resource
{
    protected static ?string $model = CategoryProduct::class;

    // Change the icon to a valid heroicon name
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Category Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->unique(CategoryProduct::class, 'slug', ignoreRecord: true),
                
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('categories')
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('400')
                    ->imageResizeTargetHeight('400')
                    ->required(),

                Forms\Components\Toggle::make('is_visible')
                    ->label('Visible to customers')
                    ->default(true),

                Forms\Components\TextInput::make('sort')
                    ->numeric()
                    ->default(0)
                    ->label('Sort Order'),
                
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::query()->pluck('name', 'id'))
                    ->required()
                    ->relationship('category', 'name'),

                Forms\Components\RichEditor::make('description')
                    ->columnSpan('full'),

                // Tambahkan Pricing di form
                Forms\Components\TextInput::make('pricing')
                    ->numeric()
                    ->label('Pricing')
                    ->default(0)
                    ->required()
                    ->helperText('Set the base price for the category product'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->square()
                    ->size(50),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\BooleanColumn::make('is_visible')
                    ->label('Visibility')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sort')
                    ->sortable(),

                // Tambahkan Pricing di table
                Tables\Columns\TextColumn::make('pricing')
                    ->label('Pricing')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoryProducts::route('/'),
            'create' => Pages\CreateCategoryProduct::route('/create'),
            'edit' => Pages\EditCategoryProduct::route('/{record}/edit'),
        ];
    }    
}

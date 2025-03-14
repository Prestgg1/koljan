<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'Products';

    protected static ?string $slug = 'products';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Ürün adı
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // Ürün açıklaması
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),

                // Fiyat
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->maxLength(10),

                // Kategori
                Select::make('category_id')
                    ->label('Kategoriya')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->required(),
                MultiSelect::make('sizes')
                    ->label('Ölçüler')
                    ->relationship('sizes', 'name')
                    ->preload()
                    ->required()
                    ->multiple(),
                // Ölçüler

                // Ürün Resmi
                FileUpload::make('image')->disk('media')->image()->optimize('webp'), // 1MB max
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Ürün Adı
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                // Ürün Fiyatı
                TextColumn::make('price')
                    ->sortable()
                    ->money('AZN'),

                // Kategori Adı
                TextColumn::make('category.name')
                    ->label('Kategoria')
                    ->sortable()
                    ->searchable(),

                // Ürün Resmi
                ImageColumn::make('image')->disk('media'),
            ])
            ->filters([
                // Filtreleme ekleyebilirsiniz
            ])
            ->actions([
                // Eylemler
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

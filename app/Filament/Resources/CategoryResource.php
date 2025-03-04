<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Products';

    protected static ?string $slug = 'categories';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Kategori adı
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                // Kategori açıklaması (isteğe bağlı)
                TextInput::make('description')
                    ->nullable()
                    ->maxLength(500),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Kategori adı
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                // Kategori açıklaması
                TextColumn::make('description')
                    ->sortable()
                    ->limit(50),
            ])
            ->filters([
                // İhtiyaca göre filtreleme ekleyebilirsiniz
            ])
            ->actions([
                // Eylemler (örneğin düzenleme, silme)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}

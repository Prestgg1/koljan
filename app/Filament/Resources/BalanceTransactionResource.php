<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalanceTransactionResource\Pages;
use App\Models\BalanceTransaction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BalanceTransactionResource extends Resource
{
    protected static ?string $model = BalanceTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('transaction_code')
                    ->label('İşlem Kodu')
                    ->disabled(),

                TextInput::make('total_price')
                    ->label('Toplam Qiymət')
                    ->disabled(),

                Repeater::make('basket_items')
                    ->label('Səbət Məhsulları')
                    ->schema([
                        TextInput::make('name')
                            ->label('Məhsul Adı')
                            ->disabled(),
                        TextInput::make('count')
                            ->label('Ədəd')
                            ->disabled(),
                        TextInput::make('price')
                            ->label('Qiymət')
                            ->disabled(),
                    ])
                    ->disableItemCreation() // Yeni kayıt eklenmesini engeller
                    ->disableItemDeletion() // Silme işlemini engeller
                    ->columns(3),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Gözlənilir',
                        'approved' => 'Təsdiqləndi',
                        'rejected' => 'İmtina edildi',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_code')->label('İşlem Kodu')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('İstifadəçi')->sortable(),
                Tables\Columns\TextColumn::make('total_price')->label('Qiymət (₼)')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->label('Tarix')->sortable()->dateTime(),
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
            'index' => Pages\ListBalanceTransactions::route('/'),
            'create' => Pages\CreateBalanceTransaction::route('/create'),
            'edit' => Pages\EditBalanceTransaction::route('/{record}/edit'),
        ];
    }
}

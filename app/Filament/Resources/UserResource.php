<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kullanıcı adı
                TextInput::make('name')
                    ->label('Adı')
                    ->required()
                    ->maxLength(255),

                // Email alanı
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                // Şifre alanı: sadece oluşturma formunda zorunlu
                TextInput::make('password')
                    ->label('Şifre')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->required(fn (string $context): bool => $context === 'create')
                    ->visible(fn (string $context): bool => $context === 'create'),

                // Rol alanı
                Select::make('role')
                    ->label('Rol')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'İstifadəçi',
                    ])
                    ->default('user')
                    ->required(),

                // Günlük kazanç (sistem tarafından güncelleniyor, ama admin düzenleyebiliyor)
                /*           TextInput::make('daily_earnings')
                    ->label('Günlük Kazanç')
                    ->numeric()
                    ->required()
                    ->default(0),
 */
                // Bakiye alanı
                TextInput::make('balance')
                    ->label('Bakiye')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Adı
                TextColumn::make('name')
                    ->label('Adı')
                    ->sortable()
                    ->searchable(),

                // Email
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                // Günlük kazanç
                /*        TextColumn::make('daily_earnings')
                    ->label('Günlük Kazanç'),
                TextColumn::make('referral_code')
                    ->label('Referans'), */
                // Rol
                BadgeColumn::make('role')
                    ->label('Rol')
                    ->colors([
                        'user' => 'success',
                        'admin' => 'danger',
                        'moderator' => 'warning',
                    ]),

                // Bakiye
                TextColumn::make('balance')
                    ->label('Bakiye'),

                // Oluşturulma tarihi
                TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                // İsteğe bağlı filtreler ekleyebilirsiniz.
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
            // Kullanıcının ilişkili verilerini (örneğin satın alınan paketler vb.) buraya ekleyebilirsiniz.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

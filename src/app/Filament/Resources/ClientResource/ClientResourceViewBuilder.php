<?php

namespace App\Filament\Resources\ClientResource;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Table;
use App\Enums\ClientProfileTypeEnum;
use Illuminate\Support\Facades\Log;

class ClientResourceViewBuilder
{
    // Funzione per costruire il form
    public static function getForm(Form $form, ?array $fields = null): Form
    {
        return $form
            ->schema([

                TextInput::make('id')
                    ->disabled(),
                Select::make('profile_type')
                    ->label('Profile Type')
                    ->options(self::getProfileTypeOptions()) // Imposta le opzioni con i valori dell'enum
                    ->required()
                    ->reactive(),

                TextArea::make('message')
                    ->nullable()
                    ->disabled()
                    ->maxLength(1000),

                Toggle::make('accept_privacy')
                    ->default(true),

                // Sezione "Agenzia" (visibile solo se 'profile_type' è "A")
                Section::make('Agency Profile')
                    ->schema([
                        TextInput::make('A_name')
                            ->label('Agency Name')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::A->value)
                            ->maxLength(255)->reactive(),
                        TextInput::make('A_country')
                            ->label('Agency Country')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::A->value),
                        TextInput::make('A_email')
                            ->label('Agency Email')
                            ->email()
                            ->requiredIf("profile_type", ClientProfileTypeEnum::A->value)
                            ->maxLength(255),
                    ])
                    ->visible(fn($get) => $get('profile_type') === ClientProfileTypeEnum::A->value), // La sezione è visibile solo per il tipo "A"

                // Sezione "Guida" (visibile solo se 'profile_type' è "G")
                Section::make('Guide Profile')
                    ->schema([
                        TextInput::make('G_name')
                            ->label('Guide Name')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::G->value)
                            ->maxLength(255),
                        TextInput::make('G_surname')
                            ->label('Guide Surname')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::G->value)
                            ->maxLength(255),
                        TextInput::make('G_country')
                            ->label('Guide Country')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::G->value)
                            ->maxLength(2),
                        TextInput::make('G_email')
                            ->label('Guide Email')
                            ->email()
                            ->requiredIf("profile_type", ClientProfileTypeEnum::G->value)
                            ->maxLength(255),
                    ])
                    ->visible(fn($get) => $get('profile_type') === ClientProfileTypeEnum::G->value), // La sezione è visibile solo per il tipo "G"

                // Sezione "Hotel" (visibile solo se 'profile_type' è "H")
                Section::make('Hotel Profile')
                    ->schema([
                        TextInput::make('R_name')
                            ->label('Hotel Name')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::H->value)
                            ->maxLength(255),
                        TextInput::make('R_email')
                            ->label('Hotel Email')
                            ->email()
                            ->requiredIf("profile_type", ClientProfileTypeEnum::H->value)
                            ->maxLength(255),
                    ])
                    ->visible(fn($get) => $get('profile_type') === ClientProfileTypeEnum::H->value), // La sezione è visibile solo per il tipo "H"

                // Sezione "Laico" (visibile solo se 'profile_type' è "L")
                Section::make('Laic Organizer Profile')
                    ->schema([
                        TextInput::make('L_name')
                            ->label('Laic Name')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::L->value)
                            ->maxLength(255),
                        TextInput::make('L_surname')
                            ->label('Laic Surname')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::L->value)
                            ->maxLength(255),
                        TextInput::make('L_country')
                            ->label('Laic Country')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::L->value)
                            ->maxLength(2),
                    ])
                    ->visible(fn($get) => $get('profile_type') === ClientProfileTypeEnum::L->value), // La sezione è visibile solo per il tipo "L"

                // Sezione "Religioso" (visibile solo se 'profile_type' è "R")
                Section::make('Religious Accompanist Profile')
                    ->schema([
                        TextInput::make('R_name')
                            ->label('Religious Name')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::R->value)
                            ->maxLength(255),
                        TextInput::make('R_surname')
                            ->label('Religious Surname')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::R->value)
                            ->maxLength(255),
                        TextInput::make('R_country')
                            ->label('Religious Country')
                            ->requiredIf("profile_type", ClientProfileTypeEnum::R->value)
                            ->maxLength(2),
                    ])
                    ->visible(fn($get) => $get('profile_type') === ClientProfileTypeEnum::R->value), // La sezione è visibile solo per il tipo "R"

                ...($fields ?? []),
            ]);
    }

    public static function getTable(
        Table  $table,
        ?array $columns = null,
        ?array $headerActions = null,
        ?array $actions = null,
        ?array $bulkActions = null,
        ?array $filters = null
    ): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable(),
                TextColumn::make('profile_type')
                    ->searchable(),
                TextColumn::make('message')
                    ->limit()
                    ->searchable(),
                IconColumn::make('accept_privacy')->boolean()->alignCenter(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ...($columns ?? []),
            ])
            ->filters($filters ?? [])
            ->headerActions($headerActions ?? [])
            ->actions($actions ?? [
                EditAction::make(),
            ])
            ->bulkActions($bulkActions ?? [
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getProfileTypeOptions(): array
    {
        $options = [];

        foreach (ClientProfileTypeEnum::cases() as $enum) {
            $options[$enum->value] = $enum->value . ' ~ ' . ClientProfileTypeEnum::getDescription($enum);
        }

        return $options;
    }

}

<?php

namespace App\Filament\Resources\RadioResource;

use App\Enums\RadioStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RadioResourceViewBuilder
{
    public static function getForm(Form $form, ?array $fields = null): Form
    {
        return $form
            ->schema([
                TextInput::make('identifier')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options(RadioStatusEnum::class)
                    ->default(RadioStatusEnum::AVAILABLE),
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
                TextColumn::make('identifier')
                    ->searchable(),
                TextColumn::make('status'),
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
}

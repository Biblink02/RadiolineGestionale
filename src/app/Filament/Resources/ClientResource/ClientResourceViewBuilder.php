<?php

namespace App\Filament\Resources\ClientResource;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientResourceViewBuilder
{
    // TODO metti nuovoi cliente con le selezioni guste
    public static function getForm(Form $form, ?array $fields = null): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('surname')
                    ->maxLength(255)
                    ->default(null),
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
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('surname')
                    ->searchable(),
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

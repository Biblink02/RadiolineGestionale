<?php

namespace App\Filament\Resources\DocumentResource;

use App\Enums\DocumentTypeEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentResourceViewBuilder
{
    public static function getForm(Form $form, ?array $fields = null): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->required()
                    ->label('Client')
                    ->searchable()
                    ->preload()
                    ->relationship(name: 'client', titleAttribute: 'name'),
                Select::make('type')
                    ->options(DocumentTypeEnum::class),
                TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('expires_at'),
                DateTimePicker::make('issued_at'),
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
                TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type'),
                TextColumn::make('number')
                    ->searchable(),
                TextColumn::make('expires_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('issued_at')
                    ->dateTime()
                    ->sortable(),
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

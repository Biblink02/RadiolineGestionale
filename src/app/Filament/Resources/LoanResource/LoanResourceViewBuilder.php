<?php

namespace App\Filament\Resources\LoanResource;

use App\Enums\LoanStatusEnum;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoanResourceViewBuilder
{
    public static function getForm(Form $form, ?array $fields = null): Form
    {
        return $form
            ->schema([
                TextInput::make('identifier')
                    ->nullable()
                    ->string(),
                DatePicker::make('loan_date')
                    ->required()
                    ->default(now())
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Utilizziamo Carbon per verificare se la data è oggi
                        $date = Carbon::parse($state);
                        $set('status', $date->isToday() ? LoanStatusEnum::ACTIVE->value : LoanStatusEnum::SCHEDULED->value);
                    }),
                Select::make('status')
                    ->options(LoanStatusEnum::class)
                    ->default(LoanStatusEnum::ACTIVE),
                DatePicker::make('return_date')
                    ->after('loan_date'),
                DatePicker::make('returned_at'),
                FileUpload::make('pdf_url'),
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
                TextColumn::make('identifier')
                    ->searchable(),
                TextColumn::make('loan_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->sortable(),
                TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('returned_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('pdf_url')
                    ->searchable()
                    ->url(fn($record) => url('/pdf/' . $record->pdf_url), true)
                    ->formatStateUsing(fn($state) => 'View PDF'),
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

<?php

namespace App\Filament\Resources\LoanResource;

use App\Enums\LoanStatusEnum;
use App\Enums\ClientProfileTypeEnum;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Filament\Forms\Components\DatePicker;
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
                TextInput::make('id')->disabled(),
                DatePicker::make('date')
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

                Select::make('booking_type')
                    ->options(ClientProfileTypeEnum::getProfileTypeOptions())
                    ->nullable(),

                TextInput::make('customer_code')
                    ->nullable()
                    ->string(),

                TextInput::make('email')
                    ->email()
                    ->nullable(),

                TextInput::make('channel')
                    ->nullable()
                    ->string(),

                TextInput::make('mobile_phone')
                    ->tel()
                    ->nullable(),

                TextInput::make('accommodation')
                    ->nullable()
                    ->string(),

                DatePicker::make('delivery_date')
                    ->nullable()
                    ->after('date')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $deliveryDate = $state ? Carbon::parse($state) : null;
                        $returnDate = $get('radio_return_date') ? Carbon::parse($get('radio_return_date')) : null;

                        if ($deliveryDate && $returnDate && $returnDate->gt($deliveryDate)) {
                            $days = $deliveryDate->diffInDays($returnDate) + 1;
                            $set('rental_days', $days);
                        } else {
                            $set('rental_days', null);
                        }
                    }),

                DatePicker::make('radio_return_date')
                    ->nullable()
                    ->after('delivery_date')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $returnDate = $state ? Carbon::parse($state) : null;
                        $deliveryDate = $get('delivery_date') ? Carbon::parse($get('delivery_date')) : null;

                        if ($deliveryDate && $returnDate && $returnDate->gt($deliveryDate)) {
                            $days = $deliveryDate->diffInDays($returnDate) + 1;
                            $set('rental_days', $days);
                        } else {
                            $set('rental_days', null);
                        }
                    }),

                TextInput::make('rental_days')
                    ->numeric()
                    ->reactive()
                    ->minValue(1)
                    ->nullable(),

                TextInput::make('power_bank')
                    ->numeric()
                    ->minValue(0)
                    ->nullable(),

                TextInput::make('spare_batteries')
                    ->numeric()
                    ->minValue(0)
                    ->nullable(),

                TextInput::make('reference')
                    ->nullable()
                    ->string(),

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
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pdf_url')
                    ->searchable()
                    ->url(fn($record) => url('/pdf/' . $record->pdf_url), true)
                    ->formatStateUsing(fn($state) => 'View PDF'),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('customer_code')
                    ->searchable()
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

<?php

namespace App\Filament\Resources;

use App\Actions\Custom\CreatePdf;
use App\Filament\Resources\LoanResource\LoanResourceViewBuilder;
use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Redirect;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected $listeners = [
        'example' => '$refresh',
    ];
    protected static ?string $navigationIcon = 'phosphor-hand-deposit-duotone';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return LoanResourceViewBuilder::getForm($form,
            fields: [Actions::make([
                Action::make('generatePdf')
                    ->button()
                    ->label('Generate PDF')
                    ->action(function (Loan $loan) {
                        CreatePdf::createPdf($loan);
                        Notification::make()
                            ->title('PDF generato con successo!')
                            ->success()
                            ->send();
                        redirect(static::getUrl('edit', ['record' => $loan->id,]));
                    }),
            ])->fullWidth(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return LoanResourceViewBuilder::getTable($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RadiosRelationManager::class,
            RelationManagers\ClientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }
}

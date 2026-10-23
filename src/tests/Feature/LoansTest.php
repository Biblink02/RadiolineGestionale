<?php

namespace Tests\Feature;

use App\Enums\LoanStatusEnum;
use App\Enums\RadioStatusEnum;
use App\Filament\Resources\LoanResource\Pages\EditLoan;
use App\Filament\Resources\LoanResource\RelationManagers\RadiosRelationManager;
use App\Filament\Resources\RadioResource\Pages\EditRadio;
use App\Filament\Resources\RadioResource\RelationManagers\LoansRelationManager;
use App\Models\Loan;
use App\Models\Radio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoansTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_loans_do_not_inherit_the_old_database_default_date(): void
    {
        $this->travelTo(now()->setDate(2026, 10, 16)->startOfDay());
        $this->assertSame('2026-10-16', Loan::create([])->fresh()->date->toDateString());
        $this->assertSame('2026-10-16', Loan::create(['date' => null])->fresh()->date->toDateString());
        $this->assertSame('2026-10-10', Loan::create(['date' => '2026-10-10'])->fresh()->date->toDateString());
    }

    public function test_only_active_loans_before_today_become_overdue(): void
    {
        $this->travelTo(now()->setDate(2026, 10, 16)->startOfDay());
        foreach ([['active', '2026-10-15', 'overdue'], ['active', '2026-10-16', 'active'], ['active', null, 'active'], ['completed', '2026-10-15', 'completed']] as [$status, $date, $expected]) {
            $loan = Loan::create(['status' => $status, 'radio_return_date' => $date]);
            $this->artisan('app:mark-overdue-loans')->assertSuccessful();
            $this->assertSame($expected, $loan->fresh()->status->value);
        }
    }

    public function test_waiting_command_catches_up_after_downtime(): void
    {
        $this->travelTo(now()->setDate(2026, 10, 16)->startOfDay());
        foreach ([['scheduled', '2026-10-15', 'waiting'], ['scheduled', '2026-10-16', 'waiting'], ['scheduled', '2026-10-17', 'scheduled'], ['completed', '2026-10-15', 'completed']] as [$status, $date, $expected]) {
            $loan = Loan::create(['status' => $status, 'delivery_date' => $date]);
            $this->artisan('app:mark-waiting-loans')->assertSuccessful();
            $this->assertSame($expected, $loan->fresh()->status->value);
        }
    }

    public function test_radio_association_is_idempotent_and_respects_availability(): void
    {
        $loan = Loan::create(['status' => LoanStatusEnum::ACTIVE]);
        $radio = Radio::create(['identifier' => '001', 'status' => RadioStatusEnum::AVAILABLE]);
        $blocked = Radio::create(['identifier' => '002', 'status' => RadioStatusEnum::UNLOANABLE]);
        $loan->attachAvailableRadios([$radio->id, $radio->id, $blocked->id]);
        $loan->attachAvailableRadios([$radio->id]);
        $this->assertSame([$radio->id], $loan->radios()->pluck('radios.id')->all());
        $this->assertDatabaseCount('loan_radio', 1);
    }

    public function test_admin_can_combine_radio_list_range_and_multiple_selection(): void
    {
        $this->actingAs(User::factory()->create());
        $loan = Loan::create(['status' => LoanStatusEnum::ACTIVE]);
        $radios = collect(['0', '001', '002', '003'])->map(fn ($id) => Radio::create(['identifier' => $id, 'status' => RadioStatusEnum::AVAILABLE]));

        foreach ([1, 2] as $attempt) {
            Livewire::test(RadiosRelationManager::class, ['ownerRecord' => $loan, 'pageClass' => EditLoan::class])
                ->callTableAction('attach', data: [
                    'multiple' => " 001\r\n001\n0\n", 'from' => '002', 'to' => '002',
                    'recordId' => [$radios[3]->id],
                ])->assertHasNoTableActionErrors();
        }
        $this->assertEqualsCanonicalizing($radios->pluck('id')->all(), $loan->radios()->pluck('radios.id')->all());
        $this->assertDatabaseCount('loan_radio', 4);
    }

    public function test_radio_can_also_be_attached_from_its_own_admin_page(): void
    {
        $this->actingAs(User::factory()->create());
        $loan = Loan::create(['status' => LoanStatusEnum::ACTIVE]);
        $radio = Radio::create(['identifier' => '001', 'status' => RadioStatusEnum::AVAILABLE]);

        Livewire::test(LoansRelationManager::class, [
            'ownerRecord' => $radio,
            'pageClass' => EditRadio::class,
        ])->callTableAction('attach', data: ['recordId' => $loan->id])->assertHasNoTableActionErrors();

        $this->assertDatabaseHas('loan_radio', ['loan_id' => $loan->id, 'radio_id' => $radio->id]);
    }

    public function test_same_day_rental_is_one_day(): void
    {
        $this->actingAs(User::factory()->create());
        $loan = Loan::create(['status' => LoanStatusEnum::ACTIVE, 'date' => '2026-10-16']);
        Livewire::test(EditLoan::class, ['record' => $loan->id])
            ->fillForm(['delivery_date' => '2026-10-16', 'radio_return_date' => '2026-10-16'])
            ->assertFormSet(['rental_days' => 1]);
    }
}

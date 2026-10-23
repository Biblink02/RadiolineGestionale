<?php

namespace Tests\Feature;

use App\Enums\RadioStatusEnum;
use App\Models\Radio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_repeated_seeding_fills_missing_radios_without_changing_existing_data(): void
    {
        $this->app['env'] = 'local';
        config(['hashing.bcrypt.rounds' => 12]);
        $this->travelTo(now()->setDate(2026, 10, 16)->startOfDay());
        $radio = Radio::create(['identifier' => '1000', 'status' => RadioStatusEnum::UNLOANABLE]);
        $user = User::factory()->create(['email' => 'a@a', 'name' => 'Existing admin']);
        $originalRadio = $radio->fresh()->getAttributes();
        $originalUser = $user->fresh()->getAttributes();

        $this->seed();
        $this->assertDatabaseCount('radios', 9000);
        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('radios', ['identifier' => '2999', 'status' => 'available']);
        $this->assertDatabaseHas('radios', ['identifier' => '3000', 'status' => 'unloanable']);
        $this->assertDatabaseHas('radios', ['identifier' => '9999', 'status' => 'unloanable']);

        Radio::where('identifier', '5000')->delete();
        $this->travel(1)->days();
        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('radios', 9000);
        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('radios', ['identifier' => '5000']);
        $this->assertSame($originalRadio, $radio->fresh()->getAttributes());
        $this->assertSame($originalUser, $user->fresh()->getAttributes());
    }

    public function test_non_local_seeding_does_not_create_development_users(): void
    {
        $this->seed();

        $this->assertDatabaseCount('radios', 9000);
        $this->assertDatabaseCount('users', 0);
    }
}

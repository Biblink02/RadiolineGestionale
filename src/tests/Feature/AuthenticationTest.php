<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Pages\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_requires_login_and_has_no_public_registration(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/login')->assertOk();
        $this->get('/register')->assertNotFound();
        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_existing_users_can_log_in_to_filament(): void
    {
        $user = User::factory()->create();
        Livewire::test(Login::class)->fillForm([
            'email' => $user->email,
            'password' => 'password',
        ])->call('authenticate')->assertHasNoFormErrors()->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);
        foreach (['', '/loans', '/clients', '/radios', '/documents', '/documents/create'] as $path) {
            $this->get('/admin'.$path)->assertOk();
        }
        $this->getJson('/api/user')->assertOk()->assertJsonPath('id', $user->id);
    }

    public function test_invalid_password_does_not_authenticate(): void
    {
        $user = User::factory()->create();
        Livewire::test(Login::class)->fillForm([
            'email' => $user->email,
            'password' => 'wrong-password',
        ])->call('authenticate')->assertHasFormErrors(['email']);
        $this->assertGuest();
    }
}

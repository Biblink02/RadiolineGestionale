<?php

namespace Tests\Feature;

use App\Http\Controllers\ClientCodeController;
use App\Http\Mail\ContactFormMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private function payload(): array
    {
        return [
            'firstName' => 'Ada', 'lastName' => 'Rossi', 'phone' => '+393331234567',
            'email' => 'ada@example.com', 'country' => 'IT', 'profileType' => 'GUIDE',
            'message' => 'Informazioni sul noleggio', 'acceptPrivacy' => true, 'language' => 'it',
        ];
    }

    public function test_contact_is_saved_mailed_and_redirected_to_its_language(): void
    {
        Mail::fake();
        $this->post('/api/request/contact-form', $this->payload())
            ->assertStatus(303)->assertRedirect('/it/contact-us');
        $this->assertDatabaseHas('contact_forms', [
            'email' => 'ada@example.com', 'country' => config('countries.IT'), 'profileType' => 'GUIDE',
        ]);
        Mail::assertSent(ContactFormMail::class, fn ($mail) => $mail->hasTo('ada@example.com') && $mail->locale === 'it');
    }

    public function test_invalid_input_is_rejected_before_database_or_mail_access(): void
    {
        Mail::fake();
        foreach (['profileType' => 'UNKNOWN', 'country' => 'XX', 'language' => 'xx', 'acceptPrivacy' => false, 'phone' => 'abc', 'message' => str_repeat('x', 10001)] as $field => $value) {
            $this->postJson('/api/request/contact-form', array_replace($this->payload(), [$field => $value]))
                ->assertUnprocessable()->assertJsonValidationErrors($field);
        }
        $this->assertDatabaseCount('contact_forms', 0);
        Mail::assertNothingSent();
    }

    public function test_client_code_validation_stops_invalid_requests(): void
    {
        Route::post('/test-client-code', [ClientCodeController::class, 'sendClientCode']);
        $this->postJson('/test-client-code', [])->assertUnprocessable()
            ->assertJsonValidationErrors(['profileType', 'acceptPrivacy']);
        $this->assertDatabaseCount('clients', 0);
    }
}

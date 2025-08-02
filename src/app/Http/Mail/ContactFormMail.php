<?php

namespace App\Http\Mail;

use App\Models\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected string $firstName,
        protected string $lastName,
        public $locale = 'en',
        protected ?ContactForm $contactForm = null
    ) {
        $this->locale = $locale ?? 'en';
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: Lang::get('emails.contact_confirmation.subject', [], $this->locale)
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.form-response',
            text: 'emails.form-response-text',
            with: [
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'locale' => $this->locale,
                'contactForm' => $this->contactForm,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

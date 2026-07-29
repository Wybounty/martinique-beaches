<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $nom,
        public readonly string $email,
        public readonly ?string $telephone,
        public readonly string $texte,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau message de contact',
            replyTo: [
                new Address($this->email, $this->nom),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
        );
    }
}

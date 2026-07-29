<?php

use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

test('the contact page is accessible', function () {
    $this->get(route('contact.create'))
        ->assertSuccessful()
        ->assertSee('Contact')
        ->assertSee('Nom*')
        ->assertSee('Email*')
        ->assertSee('Texte*');
});

test('a contact message can be sent by email', function () {
    Mail::fake();

    $this->post(route('contact.store'), [
        'nom' => 'Jean Dupont',
        'email' => 'jean@example.com',
        'telephone' => '0696123456',
        'texte' => 'Bonjour, je souhaite vous contacter.',
    ])->assertRedirect(route('contact.create'));

    Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail) {
        return $mail->nom === 'Jean Dupont'
            && $mail->email === 'jean@example.com'
            && $mail->telephone === '0696123456'
            && $mail->texte === 'Bonjour, je souhaite vous contacter.';
    });
});

test('the contact form validates required fields', function () {
    Mail::fake();

    $this->post(route('contact.store'), [])
        ->assertSessionHasErrors(['nom', 'email', 'texte']);

    Mail::assertNothingSent();
});

test('the contact form rejects filled honeypot fields', function () {
    Mail::fake();

    $this->post(route('contact.store'), [
        'nom' => 'Jean Dupont',
        'email' => 'jean@example.com',
        'texte' => 'Bonjour',
        'fax_number' => '1234567890',
    ])->assertSessionHasErrors(['fax_number']);

    Mail::assertNothingSent();
});

test('the contact form rejects invalid phone numbers', function () {
    Mail::fake();

    $this->post(route('contact.store'), [
        'nom' => 'Jean Dupont',
        'email' => 'jean@example.com',
        'telephone' => '0696 12 34 56',
        'texte' => 'Bonjour',
    ])->assertSessionHasErrors(['telephone']);

    Mail::assertNothingSent();
});

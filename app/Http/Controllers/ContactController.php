<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMessageMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Mail::to(config('mail.from.address'))
            ->send(new ContactMessageMail(
                nom: $validated['nom'],
                email: $validated['email'],
                telephone: $validated['telephone'] ?? null,
                texte: $validated['texte'],
            ));

        return redirect()
            ->route('contact.create')
            ->with('success', 'Votre message a bien ete envoye.');
    }
}

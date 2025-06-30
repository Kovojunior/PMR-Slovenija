<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    //
    public function showContact()
    {
        // Pokaži kontaktno stran
        return view('index.contact');
    }

    public function sendMessage(Request $request)
    {
        // Obdelaj podatke iz POST zahtevka
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Pošlji email
        Mail::to('zigakovac42@gmail.com')->send(new ContactFormMail($validatedData));

        // Preusmeri nazaj z obvestilom
        return redirect()->back()->with('success', 'Sporočilo uspešno poslano!');
    }
}

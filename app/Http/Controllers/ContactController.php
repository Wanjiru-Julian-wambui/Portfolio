<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
    {
        Mail::to('julianarsh26@gmail.com')->send(new ContactMail($request->validated()));

        return back()->with('success', 'Message sent successfully.');
    }
}
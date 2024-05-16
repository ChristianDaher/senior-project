<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactRequest as ContactRequestMail;
use App\Models\ContactRequest as ContactRequestModel;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome/Index');
    }

    public function faq()
    {
        $faqs = Faq::orderBy('order')->get();

        return Inertia::render('Faq', [
            'faqs' => $faqs,
        ]);
    }

    public function contact(ContactRequest $request)
    {
        $contactRequest = ContactRequestModel::make([
            'name' => $request->input('name', null),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactRequestMail($contactRequest));
    }
}

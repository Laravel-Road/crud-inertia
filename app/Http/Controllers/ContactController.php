<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contacts/Index', ['contacts' => Contact::all()]);
    }

    public function store(ContactStoreRequest $request)
    {
        Contact::create($request->validated());

        return back(303);
    }

    public function update(Request $request, Contact $contact)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        //
    }
}

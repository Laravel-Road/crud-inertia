<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contacts/Index', ['contacts' => Contact::orderBy('id', 'desc')->paginate()]);
    }

    public function store(ContactStoreRequest $request)
    {
        Contact::create($request->validated());

        return back(303);
    }

    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return back(303);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back(303);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\Email;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::with(['phoneNumbers', 'emails'])->get();

        return view('contacts', compact('contacts'));
    }
}
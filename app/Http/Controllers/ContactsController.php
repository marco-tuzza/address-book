<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\Email;

class ContactsController extends Controller
{
    /**
     * Show the list of all contacts.
     *
     * @return \Illuminate\View\View
    */

    public function index()
    {
        $contacts = Contact::with(['phoneNumbers', 'emails'])->get();

        return view('contacts', compact('contacts'));
    }

    /**
     * Show the view to add a new contact.
     *
     * @return \Illuminate\View\View
    */

    public function addContact() 
    {
        return view('add-contact');
    }

    /**
     * Store a newly created contact in storage
     * with related phone numbers and emails.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        // Validate the input data

        $request->validate([
            'first_name' => 'required',
        ]);

        // Create a new contact instance and save it to the database

        $contact = new Contact([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'title' => $request->input('title'),
            'company' => $request->input('company'),
        ]);
        $contact->save();

        // If the personal phone numbers are present, create new phone number instances
        // and associate them with the contact

        if ($request->has('personal_phone_number')) {
            $personalPhoneNumbers = $request->input('personal_phone_number');
            foreach ($personalPhoneNumbers as $personalPhoneNumber) {
                $phoneNumber = new PhoneNumber([
                    'contact_id' => $contact->id,
                    'number' => $personalPhoneNumber,
                    'type' => 'personal',
                ]);
                $contact->phoneNumbers()->save($phoneNumber);
            }
        }

        // If the home phone numbers are present, create new phone number instances
        // and associate them with the contact

        if ($request->has('home_phone_number')) {
            $homePhoneNumbers = $request->input('home_phone_number');
            foreach ($homePhoneNumbers as $homePhoneNumber) {
                $phoneNumber = new PhoneNumber([
                    'contact_id' => $contact->id,
                    'number' => $homePhoneNumber,
                    'type' => 'home',
                ]);
                $contact->phoneNumbers()->save($phoneNumber);
            }
        }

        // Create a new email instance and associate it with the contact

        $email = new Email([
            'contact_id' => $contact->id,
            'email' => $request->input('email'),
        ]);
        $contact->emails()->save($email);

        // Redirect the user to the contacts index page with a success message

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully');
    }
}
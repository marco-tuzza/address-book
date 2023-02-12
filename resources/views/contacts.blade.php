@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Phone Numbers</th>
                <th>Emails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->title }}</td>
                <td>{{ $contact->first_name }}</td>
                <td>{{ $contact->middle_name }}</td>
                <td>{{ $contact->last_name }}</td>
                <td>{{ $contact->company }}</td>
                <td>
                    @foreach($contact->phoneNumbers as $phoneNumber)
                    {{ $phoneNumber->number }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach($contact->emails as $email)
                    {{ $email->email }}<br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('contacts.add-contact') }}" class="btn btn-primary">Aggiungi Contatto</a>
@endsection
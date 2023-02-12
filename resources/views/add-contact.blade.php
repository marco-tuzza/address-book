@extends('layouts.app')
@section('content')
    <a href="/" class="btn btn-primary">Back</a>
    <form action="{{ route('contacts.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="middle_name">Middle Name</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" id="company" name="company">
        </div>
        <div class="form-group">
            <label for="personal_phone_number">Personal Phone Number</label>
            <input type="text" class="form-control" id="personal_phone_number" name="personal_phone_number[]">
        </div>
        <button type="button" id="add-button-personal" class="btn btn-primary">+</button>
        <div class="form-group">
            <label for="home_phone_number">Home Phone Number</label>
            <input type="text" class="form-control" id="home_phone_number" name="home_phone_number[]">
        </div>
        <button type="button" id="add-button-home" class="btn btn-primary">+</button>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
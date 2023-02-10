<?php
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\Email;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Creating three tables in one migration to have all 
         * related data in one place and to make sure that if 
         * a contact is deleted, all of its associated phone 
         * numbers and emails are deleted as well.
         * */ 

        Schema::create('contacts', function (Blueprint $table) 
        {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable(); // Middle name is optional
            $table->string('last_name');
            $table->string('title')->nullable(); // Title is optional (Mr., Mrs., Dr.)
            $table->string('company');
            $table->timestamps();
        });

        Schema::create('phone_numbers', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->string('number');
            $table->enum('type', ['personal', 'home'])->default('personal');
            $table->timestamps();

            // Define the foreign key relationship between phone_numbers and contacts tables
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });

        Schema::create('emails', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->string('email');
            $table->timestamps();

            // Define the foreign key relationship between emails and contacts tables
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
        });

        // Insert two dummy contacts into the database
        $contact1 = 
        [    
            'first_name' => 'John',    
            'last_name' => 'Doe',    
            'title' => 'Mr.',    
            'company' => 
            'Acme Inc.',    
            'created_at' => now(),    
            'updated_at' => now(),
        ];

        $contact2 = 
        [    
            'first_name' => 'Jane',    
            'middle_name' => 'Marie',    
            'last_name' => 'Smith',    
            'title' => 'Mrs.',    
            'company' => 'ABC Ltd.',    
            'created_at' => now(),    
            'updated_at' => now(),
        ];

        // Insert the dummy contacts and get the ids of the inserted rows
        $contact1Id = Contact::insertGetId($contact1);
        $contact2Id = Contact::insertGetId($contact2);

        // Insert dummy phone numbers for the first contact
        PhoneNumber::insert([
            [
                'contact_id' => $contact1Id,
                'number' => '123-456-7890',
                'type' => 'home',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contact_id' => $contact1Id,
                'number' => '098-765-4321',
                'type' => 'personal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert dummy emails for the first contact
        Email::insert([
            [
                'contact_id' => $contact1Id,
                'email' => 'john.doe@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contact_id' => $contact1Id,
                'email' => 'johndoe@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert dummy phone numbers for the second contact
        PhoneNumber::insert([
            [
                'contact_id' => $contact2Id,
                'number' => '555-555-5555',
                'type' => 'home',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contact_id' => $contact2Id,
                'number' => '555-555-5556',
                'type' => 'personal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert dummy emails for the second contact
        Email::insert([
            [
                'contact_id' => $contact2Id,
                'email' => 'jane.smith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contact_id' => $contact2Id,
                'email' => 'janesmith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
        Schema::dropIfExists('phone_numbers');
        Schema::dropIfExists('contacts');
    }
};
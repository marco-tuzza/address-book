<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $table = 'phone_numbers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id', 'number', 'type'
    ];

    /**
     * Get the contact that owns the phone number.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
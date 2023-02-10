<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'contact_id'
    ];

    /**
     * Get the contact that owns the email.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'email',
        'country',
        'profileType',
        'message',
    ];
}

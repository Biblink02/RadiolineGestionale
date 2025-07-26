<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

    public function info(): MorphTo
    {
        return $this->morphTo('info');
    }
}

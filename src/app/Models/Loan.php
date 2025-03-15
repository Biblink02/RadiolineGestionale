<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Loan extends Model
{

    protected $primaryKey = 'id';
    protected $guarded = [
        'uuid',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'loan_date',
        'status',
        'return_date',
        'returned_at',
        'pdf_url',
    ];

    public function info(): MorphTo
    {
        return $this->morphTo('info');
    }

    public function radios(): BelongsToMany
    {
        return $this->belongsToMany(Radio::class)->withPivot('state')->withTimestamps();
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);

    }
}

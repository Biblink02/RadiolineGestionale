<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Radio extends Model
{
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'identifier',
        'status',
    ];

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class)->withTimestamps();
    }
}

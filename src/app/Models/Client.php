<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Client extends Model
{

    protected $primaryKey = 'id';
    protected $guarded = [
        'uuid',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'surname',
    ];

    public function info(): MorphTo
    {
        return $this->morphTo('info');
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}

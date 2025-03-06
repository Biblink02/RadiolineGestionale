<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{

    protected $primaryKey = 'id';
    protected $guarded = [
        'uuid',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'client_id',
        'type',
        'number',
        'expires_at',
        'issued_at',
    ];

    public function info(): MorphTo
    {
        return $this->morphTo('info');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

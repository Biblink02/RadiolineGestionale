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
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'profile_type',
        'message',
        'accept_privacy',
        'agency_name',
        'agency_country',
        'agency_email',
        'agency_ref_name',
        'agency_ref_surname',
        'agency_mobile',
        'guide_name',
        'guide_surname',
        'guide_country',
        'guide_email',
        'guide_mobile',
        'hotel_name',
        'hotel_email',
        'hotel_ref_name',
        'hotel_ref_surname',
        'hotel_mobile',
        'laic_name',
        'laic_surname',
        'laic_country',
        'laic_email',
        'laic_mobile',
        'rel_name',
        'rel_surname',
        'rel_country',
        'rel_email',
        'rel_mobile',
    ];

    public function info(): MorphTo
    {
        return $this->morphTo('info');
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class)->withTimestamps();
    }

    public function documents(): HasMany
    {
            return $this->hasMany(Document::class);
    }
}

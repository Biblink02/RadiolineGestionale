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
        'A_name',
        'A_country',
        'A_email',
        'A_ref_name',
        'A_ref_surname',
        'A_mobile',
        'G_name',
        'G_surname',
        'G_country',
        'G_email',
        'G_mobile',
        'H_name',
        'H_email',
        'H_ref_name',
        'H_ref_surname',
        'H_mobile',
        'L_name',
        'L_surname',
        'L_country',
        'L_email',
        'L_mobile',
        'R_name',
        'R_surname',
        'R_country',
        'R_email',
        'R_mobile',
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

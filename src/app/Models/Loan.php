<?php

namespace App\Models;

use App\Enums\LoanStatusEnum;
use App\Enums\RadioStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Loan extends Model
{

    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'loan_date',
        'identifier',
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
        return $this->belongsToMany(Radio::class)->withTimestamps();
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)->withTimestamps();
    }
}

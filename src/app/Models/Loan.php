<?php

namespace App\Models;

use App\Enums\ClientProfileTypeEnum;
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
        'status',
        'date',
        'booking_type',
        'customer_code',
        'email',
        'channel',
        'mobile_phone',
        'accommodation',
        'delivery_date',
        'radio_return_date',
        'rental_days',
        'power_bank',
        'spare_batteries',
        'reference',
        'pdf_url',
    ];

    protected $casts = [
        'date' => 'date',
        'delivery_date' => 'date',
        'radio_return_date' => 'date',
        'status' => LoanStatusEnum::class,
        'booking_type' => ClientProfileTypeEnum::class,
        'radio_quantity' => 'integer',
        'rental_days' => 'integer',
        'power_bank' => 'integer',
        'spare_batteries' => 'integer',
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

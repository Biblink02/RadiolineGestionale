<?php

namespace App\Models;

use App\Enums\ClientProfileTypeEnum;
use App\Enums\LoanStatusEnum;
use App\Enums\RadioStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'rental_days' => 'integer',
        'power_bank' => 'integer',
        'spare_batteries' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Loan $loan) {
            // The legacy database default is the date of the original migration.
            $loan->date ??= today();
        });
    }

    public function radios(): BelongsToMany
    {
        return $this->belongsToMany(Radio::class)->withTimestamps();
    }

    public function attachAvailableRadios(array $radioIds): void
    {
        $this->getConnection()->transaction(function () use ($radioIds) {
            // Serialize both admin entry points without changing the existing pivot schema.
            $this->newQuery()->whereKey($this->getKey())->lockForUpdate()->firstOrFail();
            $availableIds = Radio::whereKey($radioIds)
                ->where('status', RadioStatusEnum::AVAILABLE)
                ->sharedLock()
                ->pluck('id');

            $this->radios()->syncWithoutDetaching($availableIds);
        });
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class)->withTimestamps();
    }
}

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

    protected static function boot(): void
    {
        parent::boot();

        static::deleted(function (Loan $loan) {
            // Se il loan attivo viene cancellato, tutte le radio loaned diventano available.
            Storage::disk('public')->delete($loan->pdf_url);
            self::updateRadiosStatus($loan, LoanStatusEnum::ACTIVE, RadioStatusEnum::LOANED, RadioStatusEnum::AVAILABLE);
        });

        static::updating(function (Loan $loan) {
            // Se il loan viene completato, tutte le radio loaned diventano available.
            self::updateRadiosStatus($loan, LoanStatusEnum::COMPLETED, RadioStatusEnum::LOANED, RadioStatusEnum::AVAILABLE);
            // Se il loan diventa active, le radio available diventano loaned.
            self::updateRadiosStatus($loan, LoanStatusEnum::ACTIVE, RadioStatusEnum::AVAILABLE, RadioStatusEnum::LOANED);
        });
    }

    /**
     * Aggiorna lo stato delle radio associate al loan se il loan ha uno stato specifico.
     *
     * @param Loan            $loan      Il loan da cui prendere le radio
     * @param LoanStatusEnum  $loanStatus Lo stato del loan per cui eseguire l'aggiornamento
     * @param RadioStatusEnum $from       Lo stato corrente delle radio da controllare
     * @param RadioStatusEnum $to         Lo stato che verrà assegnato alle radio
     */
    private static function updateRadiosStatus(Loan $loan, LoanStatusEnum $loanStatus, RadioStatusEnum $from, RadioStatusEnum $to): void
    {
        if ($loan->status === $loanStatus->value) {
            $radios = $loan->radios;
            foreach ($radios as $radio) {
                if ($radio->status === $from->value) {
                    $radio->status = $to->value;
                    $radio->save();
                }
            }
        }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'invoice_id',
        'payment_method',
        'amount',
        'transaction_id',
        'payment_date',
        'service_charge_amount'
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function mpesaTransaction(): BelongsTo
    {
        return $this->belongsTo(MpesaTransaction::class, 'transaction_id');
    }
}

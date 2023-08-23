<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaTransaction extends Model
{
    use HasUuids, HasFactory;

    protected $fillabe = [
        'first_name',
        'middle_name',
        'last_name',
        'transaction_type',
        'trans_id',
        'trans_time',
        'business_short_code',
        'bill_ref_number',
        'invoice_number',
        'third_party_trans_id',
        'msisdn',
        'trans_amount',
        'org_account_balance',
        'consumed'
    ];
}

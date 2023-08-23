<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccounts extends Model
{
    use HasUuids,HasFactory;

    protected $fillable = [
        'account_code',
        'account_name',
        'account_type',
        'account_balance',
    ];

}

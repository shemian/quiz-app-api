<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentSubscriptionPlan extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'student_id',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status',
        'expiry_reminder_notification_sent'
    ];

    protected $casts =[
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'expiry_reminder_notification_sent' => 'boolean'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'active_subscription', 'id');
    }

    public function subscriptionPlan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }
}

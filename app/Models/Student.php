<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Str;

class Student extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'user_id',
        'guardian_id',
        'education_system_id',
        'education_level_id',
        'Date_of_birth',
        'school_name',
        'student_phone_number',
        'marks_obtained',
        'credit',
        'centy_balance',
        'debit',
    ];


    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }

    public function educationSystem(): BelongsTo
    {
        return $this->belongsTo(EducationSystem::class);
    }

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function studentSubscriptionPlan(): HasOne
    {
        return $this->hasOne(StudentSubscriptionPlan::class, 'student_id', 'id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }


    public function brainGames(): HasMany
    {
        return $this->hasMany(BrainGame::class);
    }

}

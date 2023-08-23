<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationSystemLevelSubject extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'subject_id',
        'education_system_id',
        'education_level_id',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function educationSystem(): BelongsTo
    {
        return $this->belongsTo(EducationSystem::class, 'education_system_id');
    }

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}

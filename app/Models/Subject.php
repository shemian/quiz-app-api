<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Subject extends Model
{
    use HasUuids, HasFactory;

    protected $fillable  =[
        'teacher_id',
        'name',
        'education_system_id',
        'education_level_id',
    ];


    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    // public function results(): HasMany
    // {
    //     return $this->hasMany(Result::class);
    // }

    public function topicStrands(): HasMany
    {
        return $this->hasMany(TopicStrand::class);
    }


    public function educationSystem(): BelongsTo
    {
        return $this->belongsTo(EducationSystem::class, 'education_system_id');
    }

    public function educationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }

    public function teachers(): BelongsTo
    {
        return $this->belongsTo( Teacher::class, 'teacher_id');
    }

//    public function educationLevel(): BelongsToMany
//    {
//        return $this->belongsToMany(EducationLevel::class, 'education_level_subject')
//            ->withTimestamps();
//    }
// Remember to modify the following to the EducationLevel model:



}

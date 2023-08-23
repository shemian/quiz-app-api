<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TopicStrand extends Model
{
    use HasUuids, HasFactory;

    protected $fillable =[
        'subject_id',
        'topic_strand',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function subTopicSubStrands(): HasMany
    {
        return $this->hasMany(SubTopicSubStrand::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

}

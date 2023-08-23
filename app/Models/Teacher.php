<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function exams() : HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function subjects() : HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function questions() : HasMany
    {
        return $this->hasMany(Exam::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrainGame extends Model
{
    use HasUuids, HasFactory;
    protected $fillable  = [
        'student_id',
        'name',
        'yes_ans',
        'no_ans',
        'result_json',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

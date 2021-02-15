<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at'];

    // public function course() {
    //     return $this->belongsTo(Course::class);
    // }
}

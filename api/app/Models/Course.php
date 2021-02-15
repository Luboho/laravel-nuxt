<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title', 'description', 'is_private'];
    protected $dates = ['created_at', 'updated_at'];

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
}

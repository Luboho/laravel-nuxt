<?php

namespace App\Http\Controllers\Courses;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;

class LessonController extends Controller
{
    public function index($slug) 
    {
        $lesson = Lesson::where('slug', '=', $slug);

        if ($lesson) {
            return new LessonResource($lesson->first());
        }
    }
}

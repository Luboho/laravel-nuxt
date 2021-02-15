<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index($slug) 
    {
        $course = Course::where('slug', '=', $slug);

        if ($course) {
            return new CourseResource($course->first());
        }
    }

    public function all()
    {

    }

    // Authenticated only
    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required|min:2',
            'description' => 'required|min:2',
            'slug' => 'required|min:2|unique:courses',
            'is_private' => 'required'
        ]);
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'is_private' => $request->is_private
        ]);
        if($course) {
            return response()->json(['data' => [
                'success' => true,      // Change this to proper status code in another project.
                'course' => $course
            ]]);
        }
    }

    // Authenticated only
    public function update(Request $request)
    {

    }
}

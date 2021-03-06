<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('admin')) {
            $courses = Course::all();
        } else {
            $courses = auth()->user()->courses()->get();
        }
        $coursesAsTeacher = auth()->user()->coursesAsTeacher()->get();

        return view('courses.index', compact('courses', 'coursesAsTeacher'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $this->authorize('view-course', $course);

        return view('courses.show', compact('course'));
    }
}

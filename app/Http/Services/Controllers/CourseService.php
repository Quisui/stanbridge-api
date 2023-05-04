<?php

namespace App\Http\Services\Controllers;

use App\Models\Instructor;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseService
{
    public function queryCourses(Request $request)
    {
        $instructorId = Instructor::first()->id; // for this challenge we put the only instructor

        $coursesQuery = Course::query()
            ->where('instructor_id', $instructorId)
            ->with(['students', 'instructor'])
            ->when($request->instructorId, function ($query) use ($request) {
                $query->withWhereHas('instructor', function ($query) use ($request) {
                    $query->where('id', $request->instructorId);
                });
            })
            ->when($request->present, function ($query) use ($request) {
                $query->withWhereHas('students', function ($query) use ($request) {
                    $value = $request->present === 'true' ? 1 : $request->present;
                    $query->where('present', $value);
                });
            });

        return $coursesQuery->paginate($request->query('perPage', 10))->withQueryString();
    }
}

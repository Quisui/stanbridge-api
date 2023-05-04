<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\api\v1\CourseResource;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        $courses = $coursesQuery->paginate($request->query('perPage', 10))->withQueryString();

        return CourseResource::collection($courses)->response()
            ->getData(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return CourseResource::make($course->load(['students', 'instructor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->present($request->student_id, $request->present);
        if (! $course->save()) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'Student Status not updated, check with support');
        }
        return response()->json([
            'message' => 'Present status updated successfully for student:' . Student::find($request->student_id)->first_name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\api\v1\CourseResource;
use App\Http\Services\Controllers\CourseService;
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
    public function index(Request $request, CourseService $courseService)
    {
        return CourseResource::collection($courseService->queryCourses($request))->response()
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
        if (!$course->save()) {
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

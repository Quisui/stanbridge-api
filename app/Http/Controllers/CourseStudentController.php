<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseStudentRequest;
use App\Http\Requests\UpdateCourseStudentRequest;
use App\Models\CourseStudent;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseStudentRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseStudent $courseStudent)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseStudentRequest $request, CourseStudent $courseStudent)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $courseStudent)
    {
    }
}

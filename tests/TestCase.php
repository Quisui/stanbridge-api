<?php

namespace Tests;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public Course $course;
    public Instructor $instructor;
    public Student $student;
    public function setUp(): void
    {
        parent::setUp();

        // Migrate and seed the testing database
        Artisan::call('migrate:fresh', ['--env' => 'testing']);
        Artisan::call('db:seed', ['--env' => 'testing']);

        $this->course = Course::first();
        $this->instructor = Instructor::first();
        $this->student = Student::first();
    }
}

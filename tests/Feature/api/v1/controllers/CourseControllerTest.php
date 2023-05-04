<?php

namespace Tests\Feature\api\v1\controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testAllCoursesCanBeReturned(): void
    {

        $response = $this->getJson('/api/courses');
        $response->assertStatus(200)
            ->assertJsonPath('data.0.instructor.id', $this->instructor->id)
            ->assertJsonPath('data.0.id', $this->course->id);
    }

    public function testAllCoursesCanHaveQueryFilters(): void
    {
        $response = $this->getJson('/api/courses?perPage=5');

        $response->assertStatus(200)
            ->assertJsonPath('meta.per_page', 5);
    }

    public function testCoursesCanBeFilterInPresentOrNotStudents(): void
    {

        $withNoPresense = Course::query()
            ->where('instructor_id', $this->instructor->id)
            ->with(['students', 'instructor'])->withWhereHas('students', function ($query) {
                $query->where('present', false);
            })->get()->toArray();

        $response = $this->getJson('/api/courses?present=false');
        $totalNoAssist = count($withNoPresense[0]['students']);
        if ($totalNoAssist < 1) {
            $this->markTestSkipped('skipping this test');
        }
        $response->assertStatus(200)
            ->assertJsonCount($totalNoAssist, 'data.0.students');;


        $response = $this->getJson('/api/courses?present=false');
        $totalAssist = count($withNoPresense[0]['students']);
        if ($totalAssist < 1) {
            $this->markTestSkipped('skipping this test');
        }
        $response->assertStatus(200)
            ->assertJsonCount($totalAssist, 'data.0.students');
    }

    public function testPresentStatusCanBeUpdatedInCourse(): void
    {

        $this->putJson('/api/courses/' . $this->course->id, [
            'course_id' => $this->course->id,
            'student_id' => $this->student->id,
            'present' => true,
        ])
            ->assertOk()
            ->assertJsonFragment(['message' => 'Present status updated successfully for student:' . $this->student->first_name]);
    }

    public function testPresentStatusCanBeUpdatedInCourseValidations(): void
    {
        $this->putJson('/api/courses/' . $this->course->id, [])
            ->assertInvalid('course_id')
            ->assertInvalid('student_id')
            ->assertInvalid('present');
    }

    public function testSpecificCourseCanBeReturned(): void
    {
        $this->getJson('/api/courses/' . $this->course->id)
            ->assertOk()
            ->assertJsonPath('data.id', $this->course->id);

        $this->getJson('/api/courses/' . rand(55, 66)) //for now random, not whole implementation needed
            ->assertStatus(404);
    }
}

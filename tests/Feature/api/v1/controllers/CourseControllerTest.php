<?php

namespace Tests\Feature\api\v1\controllers;

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
        $instructor = Instructor::factory()->create();

        $course = $instructor->courses()->create([
            'name' => 'Eaque.'
        ]);

        $course->students()->attach([
            1 => ['present' => true],
            2 => ['present' => false],
            3 => ['present' => true]
        ]);

        $response = $this->getJson('/api/courses?present=false');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');

        $response = $this->getJson('/api/courses?present=true');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
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

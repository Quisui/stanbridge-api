<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseStudent>
 */
class CourseStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $course = Course::inRandomOrder()->first()->id;
        $studentIds = $this->getStudentId(100);

        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'student_id' => $studentIds,
            'present' => $this->faker->boolean(),
        ];
    }

    public function getStudentId($maxAttempts = 10)
    {
        $studentId = Student::all();
        $random = $studentId->random()->id;
        if (empty(CourseStudent::where('student_id', $random)->first())) {
            return $random;
        }

        if ($maxAttempts > 0) {
            return $this->getStudentId($maxAttempts - 1);
        }

        throw new Exception("Maximum attempts reached to find a unique student ID");
    }
}

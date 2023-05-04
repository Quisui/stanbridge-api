<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_students')->truncate();

        $courseIds = Course::pluck('id')->toArray();
        $studentIds = Student::limit(25)->pluck('id')->toArray();

        shuffle($studentIds);

        foreach ($courseIds as $courseId) {
            $numStudents = rand(1, count($studentIds));
            $courseStudents = array_splice($studentIds, 0, $numStudents);

            foreach ($courseStudents as $studentId) {
                CourseStudent::create([
                    'course_id' => $courseId,
                    'student_id' => $studentId,
                    'present' => rand(0, 1)
                ]);
            }
        }
    }
}

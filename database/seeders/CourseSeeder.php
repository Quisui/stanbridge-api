<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maxInstructor = Instructor::max('id');
        $minInstructor = Instructor::min('id');
        Course::factory(1)->create(
            ['instructor_id' => rand($minInstructor, $maxInstructor),]
        );
    }
}

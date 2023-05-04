<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CourseStudent
 *
 * @property int $id
 * @property int $course_id
 * @property int $student_id
 * @property int $present
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\CourseStudentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent wherePresent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CourseStudent extends Model
{
    use HasFactory;
}

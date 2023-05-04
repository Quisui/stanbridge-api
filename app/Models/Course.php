<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'instructor_id'];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_students')->withPivot('present')->withTimestamps();
    }

    public function present($studentId, $present = true)
    {
        $this->students()->updateExistingPivot($studentId, ['present' => $present]);
    }
}

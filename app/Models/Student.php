<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email'];

    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('present')
            ->withTimestamps();
    }

    public function instructors()
    {
        return $this->hasManyThrough(Instructor::class, Course::class);
    }
}

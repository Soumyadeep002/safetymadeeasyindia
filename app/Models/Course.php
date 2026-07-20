<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_title',
        'tutor',
        'subject',
        'course_type',
        'image',
        'course_para_1',
        'course_para_2',
        'course_para_3',
        'course_para_4',
        'level',
        'duration',
        'students',
        'question_1',
        'ans_1',
        'question_2',
        'ans_2',
        'question_3',
        'ans_3',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function enrolledUsersCount(): int
    {
        return $this->enrollments()->count();
    }

    public function imageUrl(): string
    {
        return url('assets/images/course/'.$this->image);
    }

    public function isListed(): bool
    {
        return (bool) $this->is_active;
    }
}

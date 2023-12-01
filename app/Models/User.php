<?php

namespace App\Models;

use App\Notifications\AdminMailResetPasswordToken;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected
        $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'mobile',
        'parent_mobile',
        'password',
        'code',
        'login_type',
        'mac_address',
        'browser_token',
        'last_login_ip',
        'is_banned',
        'course_id',
        'available_balance',
        'frozen_balance',
        'unique_token',
        'avatar',
        'group_id',
        'is_notifiable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected
        $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected
        $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

    public function sendPasswordResetNotification($token)
    {
        if ($this->hasRole('admin')) {
            $this->notify(new AdminMailResetPasswordToken($token));
        } else {
            $this->notify(new MailResetPasswordToken($token));
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    public function instructor_courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function questions()
    {
        return $this->hasMany(Qa::class, 'student_id');
    }

    public function getAvatarAttribute($value)
    {
        return asset($value);
    }

    public function is_enrolled($course)
    {
        $boughtCourse = $this->courses()->where('course_id', $course->id)->first();
        if ($boughtCourse && !$boughtCourse->pivot->expired) {
            return true;
        }
        return false;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course', 'student_id', 'course_id')
            ->withPivot('progress', 'expired')
            ->withTimestamps();
    }

    public function group()
    {
        return $this->belongsTo(StudentsGroup::class, 'group_id');
    }

    public function quizzes_attempts()
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }

    public function assignments_attempts()
    {
        return $this->hasMany(AssignmentAttempt::class, 'student_id');
    }

    public function attendance()
    {
        return $this->belongsToMany(Lesson::class, 'student_views', 'student_id', 'lesson_id')->withPivot('number_of_views');
    }

    public function studentTakeQuiz($quiz)
    {
        $quizzes_attempts = $this->quizzes_attempts->pluck('quiz_id')->toArray();
        if (in_array($quiz->id, $quizzes_attempts)) {
            return true;
        }
        return false;
    }

    public function studentTakeAssignment($assignment)
    {
        $assignments_attempts = $this->assignments_attempts->pluck('assignment_id')->toArray();
        if (in_array($assignment->id, $assignments_attempts)) {
            return true;
        }
        return false;
    }

    public function studentAnswersAssignmentQuestion($assignment, $question)
    {
        $attempt = $this->assignments_attempts->where('assignment_id', $assignment->id)->first();
        if ($attempt) {
            foreach ($attempt->answers as $answer) {
                if ($question->title == $answer->title) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
}

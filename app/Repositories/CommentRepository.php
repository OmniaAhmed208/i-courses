<?php


namespace App\Repositories;


use App\Models\CourseRate;

class CommentRepository implements CommentRepositoryInterface
{
    public function first_three($course_id)
    {
        return CourseRate::with('user')->where('course_id', $course_id)->latest()->limit(3)->get();
    }

    public function all($course_id)
    {
        return CourseRate::with('user')->where('course_id', $course_id)->latest()->get();
    }

    public function store($data, $course)
    {
        $rate = CourseRate::create($data);
        $new_rate = number_format(CourseRate::where('course_id', $course->id)->sum('rate') / CourseRate::where('course_id', $course->id)->count(), 2);
        $course->update([
            'total_rate' => $new_rate
        ]);
        return $rate;
    }
}

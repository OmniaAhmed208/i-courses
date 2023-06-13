<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Notifications\NewLessonAdded;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LessonsController extends Controller
{
    public function store_ajax(StoreLessonRequest $request, Course $course)
    {
        $link = $request->link;
        $data = $request->validated();
        $data['time'] = (int)$request->time * 60;
        if ($request->type == 'internal_link' && $request->hasFile('video')) {
            $link = VideoService::storeCourseLesson($request->video, $course->id);
            $data['time'] = VideoService::get_video_duration('storage/' . $link);
        }
        if ($request->type == 'youtube') {
            parse_str(parse_url($link, PHP_URL_QUERY), $my_array_of_vars);
            $link = $my_array_of_vars['v'];
        }
        $data['link'] = $link;
        $lesson = Lesson::create($data);
        $new_total_time = (int)$course->total_duration + (int)$data['time'];
        $course->update([
            'total_duration' => $new_total_time
        ]);

        //notify students
        if ($course->status == Course::STATUS_PUBLISHED) {
            Notification::send($course->students, new NewLessonAdded($course));
        }
        return response()->json(['status' => 'ok', 'message' => $lesson->name . ' ' . __('site.added_successfully'), 'lesson_id' => $lesson->id]);
    }

    public function remove_ajax(Request $request)
    {
        $lesson = Lesson::find($request->lesson_id);
        if ($lesson && $lesson->type === 'internal_link') {
            $deleted = VideoService::remove_video($lesson->link);
            if ($deleted) {
                $course = $lesson->section->course;
                $course->update([
                    'total_duration' => $course->total_duration - $lesson->time
                ]);
                $lesson->delete();
                return response()->json(['status' => 'ok', 'message' => __('site.deleted_successfully')]);
            } else {
                return response()->json(['status' => 'error', 'message' => __('site.something_went_wrong_try_again')], 500);
            }
        } elseif(!is_null($lesson)) {
            $course = $lesson->section->course;
            $course->update([
                'total_duration' => $course->total_duration - $lesson->time
            ]);
            $lesson->delete();
            return response()->json(['status' => 'ok', 'message' => __('site.deleted_successfully')]);
        }

        return response()->json(['status' => 'error', 'message' => __('site.something_went_wrong_try_again')], 500);
    }
}

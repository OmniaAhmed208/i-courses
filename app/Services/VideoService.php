<?php


namespace App\Services;

use File;


class VideoService
{
    public static function storeCourseLesson($video, $course_name)
    {
        if (!File::exists(storage_path('app/public/courses/' . $course_name . '/lessons'))) {
            File::makeDirectory(storage_path('app/public/courses/' . $course_name . '/lessons'));
        }
        $folder_path = 'public/courses/' . $course_name . '/lessons';
        $extension = $video->getClientOriginalExtension();
        $name = uniqid() . time() . '.' . $extension;
        $video->storeAs($folder_path, $name);

        return 'courses/' . $course_name . '/lessons/' . $name;
    }

    public static function get_video_duration($path)
    {
        $getID3 = new \getID3;
        $file = $getID3->analyze($path);
        return $file['playtime_seconds'];
    }

    public static function remove_video($path)
    {
        $arr = explode('/', $path);
        unset($arr[0]);
        $file_to_delete = storage_path('app/public/' . implode('/', $arr));
        if (File::exists($file_to_delete)) {
            File::delete($file_to_delete);
        }
        return true;
    }
}

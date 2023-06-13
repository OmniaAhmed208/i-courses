<?php


namespace App\Services;

use File;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageService
{
    public static function store_base64_profile_picture($image_64)
    {
        if (!File::exists(storage_path('app/public/profile_pictures/'))) {
            File::makeDirectory(storage_path('app/public/profile_pictures/'));
        }

        $extension = $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $time = time();
        $image_name = 'profile_pictures/' . $time . '.' . $extension;

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace(' ', '+', str_replace($replace, '', $image_64));

        Storage::disk('local')->put('public/' . $image_name, base64_decode($image));

        return 'storage/' . $image_name;
    }

    public static function storeProfilePicture($image)
    {
        if (!File::exists(storage_path('app/public/profile_pictures/'))) {
            File::makeDirectory(storage_path('app/public/profile_pictures/'));
        }
        $extension = $image->getClientOriginalExtension();
        $time = time();
        $image_name = 'profile_pictures/' . $time . '.' . $extension;

        Image::make($image)
            ->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/' . $image_name));

        return 'storage/' . $image_name;
    }

    public static function deleteProfilePicture($image)
    {
        $arr = explode('/', $image);
        $image_name = 'profile_pictures/' . $arr[count($arr) - 1];
        $path = storage_path('app/public/' . $image_name);

        if (File::exists($path)) {
            File::delete($path);
            return true;
        }
        return false;
    }

    public static function storeWebsiteImage($image)
    {
        if (!File::exists(storage_path('app/public/website_images/'))) {
            File::makeDirectory(storage_path('app/public/website_images/'));
        }
        $extension = $image->getClientOriginalExtension();
        $time = time();
        $image_name = 'website_images/' . $time . '.' . $extension;

        Image::make($image)->save(storage_path('app/public/' . $image_name));
        return 'storage/' . $image_name;
    }

    public static function deleteWebsiteImage($image)
    {
        $arr = explode('/', $image);
        $image_name = 'website_images/' . $arr[count($arr) - 1];
        $path = storage_path('app/public/' . $image_name);

        if (File::exists($path)) {
            File::delete($path);
            return true;
        }
        return false;
    }

    public static function updateCourseImage($image, $course)
    {
        $title = $course->id;
        $old_image_path = self::edit_path($course->image);
        $old_small_image_path = self::edit_path($course->small_image);
        if (File::exists($old_image_path)) {
            File::delete($old_image_path);
        }
        if (File::exists($old_small_image_path)) {
            File::delete($old_small_image_path);
        }
        return self::storeCourseImage($image, $title);
    }

    private static function edit_path($path)
    {
        $arr = explode('/', $path);
        unset($arr[0], $arr[1], $arr[2], $arr[3]);
        return storage_path('app/public/' . implode('/', $arr));
    }

    public static function storeCourseImage($image, $title)
    {
        $title = strtolower($title);
        if (!File::exists(storage_path('app/public/courses/' . $title))) {
            File::makeDirectory(storage_path('app/public/courses/' . $title));
        }
        $extension = $image->getClientOriginalExtension();
        $time = time();
        $normal_image_name = 'courses/' . $title . '/' . $time . '.' . $extension;
        $small_image_name = 'courses/' . $title . '/small_' . $time . '.' . $extension;
        Image::make($image)->save(storage_path('app/public/' . $normal_image_name));

        Image::make($image)
            ->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/' . $small_image_name), 60);

        return ['normal' => $normal_image_name, 'small' => $small_image_name];
    }

    public static function storeReceiptImage($image)
    {
        if (!File::exists(storage_path('app/public/receipt_images'))) {
            File::makeDirectory(storage_path('app/public/receipt_images/'));
        }

        $extension = $image->getClientOriginalExtension();
        $time = time();
        $image_name = 'receipt_images/' . $time . '.' . $extension;
        Image::make($image)->save(storage_path('app/public/' . $image_name));

        return $image_name;
    }

    public static function storeAnswerImage($image, $title)
    {
        if (!File::exists(storage_path('app/public/courses/' . $title . '/quiz_answers'))) {
            File::makeDirectory(storage_path('app/public/courses/' . $title . '/quiz_answers'));
        }
        $extension = $image->getClientOriginalExtension();
        $time = time();
        $image_name = 'courses/' . $title . '/quiz_answers/' . uniqid() . $time . '.' . $extension;

        Image::make($image)->save(storage_path('app/public/' . $image_name));

        return $image_name;
    }

    public static function storeQuestionImage($image)
    {
        if (!File::exists(storage_path('app/public/questions'))) {
            File::makeDirectory(storage_path('app/public/questions/'));
        }

        $extension = $image->getClientOriginalExtension();
        $time = time();
        $image_name = 'questions/' . $time . '.' . $extension;
        Image::make($image)->save(storage_path('app/public/' . $image_name));

        return $image_name;
    }

    public static function deleteQuestionImage($image)
    {
        $path = storage_path('app/public/' . $image);
        if (File::exists($path)) {
            File::delete($path);
            return true;
        }
        return false;
    }
}

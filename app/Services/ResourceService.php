<?php

namespace App\Services;

use File;

class ResourceService
{
    public static function store($file, $folder_name)
    {
        $path = storage_path('app/public/courses/' . $folder_name . '/resources');
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }
        $size = self::formatBytes($file->getSize());
        $extension = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $hashed_name = $folder_name . uniqid() . time() . '.' . $extension;
        $folder_path = 'public/courses/' . $folder_name . '/resources';
        $file->storeAs($folder_path, $hashed_name);
        $final_name = $folder_path . '/' . $hashed_name;
        return ['course_id' => $folder_name, 'path' => $final_name, 'name' => $name, 'extension' => $extension, 'size' => $size];
    }

    private static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int)$size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    public static function delete($file)
    {
        $file_to_delete = storage_path('app/' . $file->path);
        if (File::exists($file_to_delete)) {
            File::delete($file_to_delete);
            return true;
        }
        return false;
    }
}

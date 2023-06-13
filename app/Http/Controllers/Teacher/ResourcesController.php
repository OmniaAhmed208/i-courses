<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResorcesRequest;
use App\Models\Course;
use App\Models\Resource;
use App\Notifications\NewResourceAdded;
use App\Services\ResourceService;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    public function index(Course $course)
    {
        $resources = $course->resources()->latest()->get();
        return view('teacher.courses.resources.index', compact('resources', 'course'));
    }

    public function create(Course $course)
    {
        return view('teacher.courses.resources.create', compact('course'));
    }

    public function store(StoreResorcesRequest $request, Course $course)
    {
        $files = $request->file('files');
        foreach ($files as $file) {
            Resource::create(ResourceService::store($file, $course->id));
        }

        //notify students
        Notification::send($course->students, new NewResourceAdded($course));
        session()->flash('success', __('site.files_uploaded'));
        return redirect()->route('teacher.courses.resources.index', $course->slug);
    }

    public function destroy($course, Resource $resource)
    {
        if (ResourceService::delete($resource)) {
            $resource->delete();
            session()->flash('success', __('site.files_deleted'));
        } else {
            session()->flash('error', __('site.something_wrong'));
        }
        return redirect()->back();
    }

    public function download($course, Resource $resource)
    {
        return Storage::download($resource->path, $resource->name);
    }
}

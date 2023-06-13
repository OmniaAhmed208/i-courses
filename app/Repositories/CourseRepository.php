<?php


namespace App\Repositories;


use App\Models\Course;
use App\Models\CourseSection;

class CourseRepository implements CourseRepositoryInterface
{
    public function all($request)
    {
        $q = Course::query();
        $q->with('instructor')->withCount('rates', 'lessons')->where('status', Course::STATUS_PUBLISHED);
        if ($request->has('sorting')) {
            if ($request->sorting == 'newest') {
                return $q->latest()->paginate(10);
            } elseif ($request->sorting == 'oldest') {
                return $q->paginate(10);
            } elseif ($request->sorting == 'high-rated') {
                return $q->orderBy('total_rate', 'asc')->paginate(10);
            } elseif ($request->sorting == 'high-to-low') {
                return $q->orderBy('price', 'asc')->paginate(10);
            } elseif ($request->sorting == 'low-to-high') {
                return $q->orderBy('price', 'desc')->paginate(10);
            }
        }
        if ($request->has('search')) {
            $q->where('title', 'LIKE', "%" . $request->search . "%");
        }
        if (!is_null($request->min_price)) {
            $q->where('price', '>=', $request->min_price);
        }
        if (!is_null($request->max_price)) {
            $q->where('price', '<=', $request->max_price);
        }

        if ($request->has('category_id')) {
            $q->whereIn('category_id', array_keys($request->category_id));
        }
        if ($request->has('level') && key($request->level) != 'all') {
            $q->where('level', 'LIKE', "%" . key($request->level) . "%");
        }
        if ($request->has('language')) {
            $q->where('language', $request->language);
        }
        if ($request->has('rating')) {
            $q->where('total_rate', ">=", $request->rating);
        }

        return $q->paginate(10);
    }

    public function my_courses()
    {
        return auth()->user()->courses ?? collect([]);
    }

    public function search($search_word)
    {
        return Course::with('instructor')->withCount('rates', 'lessons')->where('status', Course::STATUS_PUBLISHED)->where('title', 'LIKE', '%' . $search_word . '%')->paginate(100);
    }

    public function get_by_slug($slug)
    {
        return Course::with('instructor', 'sections.lessons')
            ->withCount('resources', 'students', 'quizzes', 'lessons', 'rates')
            ->where('status', Course::STATUS_PUBLISHED)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function latest_courses_widget($slug)
    {
        return Course::with('instructor')
            ->where('status', Course::STATUS_PUBLISHED)
            ->where('slug', '!=', $slug)
            ->limit(3)
            ->latest('id')
            ->get();
    }

    public function sections($slug)
    {
        $course = Course::where('status', Course::STATUS_PUBLISHED)->where('slug', $slug)->first();
        if ($course) {
            return CourseSection::with('children')->where('parent_id', null)
                ->where('course_id', $course->id)
                ->orderBy('created_at')
                ->get();
        }
        return [];
    }

    public function resources($slug)
    {
        return Course::where('status', Course::STATUS_PUBLISHED)->where('slug', $slug)->first()->resources;
    }

}

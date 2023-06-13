<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseSearchResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseRate;
use App\Models\Lesson;
use App\Models\Resource;
use App\Models\StudentView;
use App\Models\User;
use App\Repositories\CommentRepository;
use App\Repositories\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    private $courseRepository;
    private $commentRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, CommentRepository $commentRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index(Request $request)
    {
        $courses = $this->courseRepository->all($request);
        $categories = Category::with('childrens')->get()->filter(function ($cat) {
            return count($cat->childrens) == 0;
        });

        return view('website.courses.index', compact('courses', 'categories'));
    }

    public function my_courses()
    {
        $courses = $this->courseRepository->my_courses();
        return view('website.courses.my_courses', compact('courses'));
    }

    public function search(Request $request)
    {
        $courses = $this->courseRepository->search($request->search);
        $categories = Category::with('childrens')->get()->filter(function ($cat) {
            return count($cat->childrens) == 0;
        });
        return view('website.courses.index', compact('courses', 'categories'));
    }

    public function live_search(Request $request)
    {
        $courses = $this->courseRepository->search($request->search)->take(5);
        return response()->json(['status' => 'ok', 'data' => CourseSearchResource::collection($courses)]);
    }

    public function show($course)
    {
        $course = $this->courseRepository->get_by_slug($course);
        if ($course) {
            views($course)->record();
            $rate_percentage = ['five' => 0, 'four' => 0, 'three' => 0, 'two' => 0, 'one' => 0];
            $all_rates = CourseRate::where('course_id', $course->id)->get();
            if (count($all_rates) > 0) {
                $rate_count = ['five' => 0, 'four' => 0, 'three' => 0, 'two' => 0, 'one' => 0];
                foreach ($all_rates as $rate) {
                    if ($rate->rate == 5) {
                        $rate_count['five'] = $rate_count['five'] += 1;
                    } elseif ($rate->rate == 4) {
                        $rate_count['four'] = $rate_count['four'] += 1;
                    } elseif ($rate->rate == 3) {
                        $rate_count['three'] = $rate_count['three'] += 1;
                    } elseif ($rate->rate == 2) {
                        $rate_count['two'] = $rate_count['two'] += 1;
                    } elseif ($rate->rate == 1) {
                        $rate_count['one'] = $rate_count['one'] += 1;
                    }
                }
                $rate_percentage['five'] = number_format(($rate_count['five'] / count($all_rates) * 100), 2);
                $rate_percentage['four'] = number_format(($rate_count['four'] / count($all_rates) * 100), 2);
                $rate_percentage['three'] = number_format(($rate_count['three'] / count($all_rates) * 100), 2);
                $rate_percentage['two'] = number_format(($rate_count['two'] / count($all_rates) * 100), 2);
                $rate_percentage['one'] = number_format(($rate_count['one'] / count($all_rates) * 100), 2);
            }

            $enrolled = null;
            if (auth()->user()) {
                $enrolled = in_array($course->id, auth()->user()->courses->pluck('id')->toArray());
            }
            $rates = $this->commentRepository->first_three($course->id);
            $latest_courses = $this->courseRepository->latest_courses_widget($course->slug);
            return view('website.courses.show', compact('course', 'rate_percentage', 'enrolled', 'all_rates', 'rates', 'latest_courses'));
        }
        return abort(404);
    }

    public function study($course)
    {
        $course = Course::with('sections.lessons', 'instructor.teacher', 'resources', 'quizzes', 'assignments', 'announcements', 'qas')->where('slug', $course)->firstOrFail();
        $code = auth()->user()->code;
        return view('website.courses.details.index', compact('course', 'code'));
    }

    public function download($course, Resource $resource)
    {
        return Storage::download($resource->path, $resource->name);
    }

    public function is_lesson_available(Lesson $lesson, User $user)
    {
        if ($lesson->number_of_views == 0) {
            return response()->json(['success' => true, 'available' => true], 200);
        } elseif ($lesson->number_of_views > 0) {
            $views = StudentView::where('lesson_id', $lesson->id)->where('student_id', $user->id)->first();
            if (is_null($views)) {
                return response()->json(['success' => true, 'available' => true], 200);
            } elseif ($views->number_of_views < $lesson->number_of_views) {
                return response()->json(['success' => true, 'available' => true], 200);
            }
        }
        return response()->json(['success' => true, 'available' => false], 200);
    }

    public function student_clicked_lesson(Request $request)
    {
        $lesson = Lesson::find($request->lesson);
        $user = auth()->user();
        if ($lesson) {
            $views = StudentView::where('lesson_id', $lesson->id)->where('student_id', $user->id)->first();
            if (is_null($views)) {
                StudentView::create([
                    'student_id' => $user->id,
                    'lesson_id' => $lesson->id,
                    'number_of_views' => 0
                ]);
            }
        }
        return response()->json(['success' => true], 200);
    }

    public function student_watched_lesson(Request $request)
    {
        $lesson = Lesson::find($request->lesson);
        $user = $request->has('user_id') ? User::find($request->user_id) : auth()->user();
        if ($lesson && (is_null($lesson->number_of_views) || $lesson->number_of_views == 0)) {
            return response()->json(['success' => true], 200);
        } elseif ($lesson && !is_null($lesson->number_of_views) && $lesson->number_of_views > 0) {
            $views = StudentView::where('lesson_id', $lesson->id)->where('student_id', $user->id)->first();
            if (is_null($views)) {
                StudentView::create([
                    'student_id' => $user->id,
                    'lesson_id' => $lesson->id,
                    'number_of_views' => 1
                ]);
                return response()->json(['success' => true], 200);
            } elseif (!is_null($lesson->number_of_views) && $views->number_of_views < $lesson->number_of_views) {
                $views->update([
                    'number_of_views' => $views->number_of_views + 1
                ]);
                return response()->json(['success' => true], 200);
            }
        }
        return response()->json(['success' => false], 200);
    }

}

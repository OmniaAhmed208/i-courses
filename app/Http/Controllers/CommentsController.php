<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Course;
use App\Repositories\CommentRepositoryInterface;

class CommentsController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index(Course $course)
    {
        $rates = $this->commentRepository->all($course->id);
        return view('website.courses.reviews.index', compact('course', 'rates'));
    }

    public function post_review(StoreReviewRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['course_id'] = $course->id;
        $data['user_id'] = auth()->user()->id;
        $this->commentRepository->store($data, $course);
        session()->flash('success', 'review added successfully');
        return redirect()->back();
    }
}

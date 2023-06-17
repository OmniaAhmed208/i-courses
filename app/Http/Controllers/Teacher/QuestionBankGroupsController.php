<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankGroupRequest;
use App\Models\BankGroup;
use App\Models\Course;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class QuestionBankGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $courses = Course::where('instructor_id', auth()->user()->id)->get();
        $courses_ids = $courses->pluck('id')->toArray();
        $groups = BankGroup::with('course')->whereIn('course_id', $courses_ids)->withCount('questions')->get();
        
        return view('teacher.questions_bank.groups.index', compact('groups', 'courses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param BankGroupRequest $request
     * @return RedirectResponse
     */
    public function store(BankGroupRequest $request)
    {
        BankGroup::create($request->validated());
        session()->flash('success', __('site.bank_group_created'));
        return redirect()->route('teacher.questions_bank.groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BankGroup $group
     * @return Application|Factory|View|void
     */
    public function edit(BankGroup $group)
    {
        $courses = Course::where('instructor_id', auth()->user()->id)->get();
        return view('teacher.questions_bank.groups.edit', compact('group', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BankGroupRequest $request
     * @param BankGroup $group
     * @return RedirectResponse
     */
    public function update(BankGroupRequest $request, BankGroup $group)
    {
        $group->update($request->validated());
        session()->flash('success', __('site.bank_group_updated'));
        return redirect()->route('teacher.questions_bank.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $group_id
     * @return RedirectResponse
     */
    public function destroy($group_id)
    {
        BankGroup::destroy($group_id);
        session()->flash('success', __('site.bank_group_deleted'));
        return redirect()->back();
    }
}

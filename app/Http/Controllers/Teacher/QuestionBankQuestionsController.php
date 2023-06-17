<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankQuestionRequest;
use App\Models\BankGroup;
use App\Models\BankQuestion;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class QuestionBankQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $group
     * @return Application|Factory|Response|View
     */
    public function index($group)
    {
        $groupedQuestions = BankQuestion::with('group')->where('group_id', $group)->paginate(50);
        return view('teacher.questions_bank.questions.index', compact('groupedQuestions', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BankQuestionRequest $request
     * @param $group
     * @return RedirectResponse
     */
    public function store(BankQuestionRequest $request, BankGroup $group)
    {
        $data = $request->validated();
        $data['group_id'] = $group->id;
        if ($data['type'] == 'mcq') {
            $choices = [];
            foreach ($request['answers'] as $key => $answer) {
                if ($request->correct_answer - 1 == $key) {
                    array_push($choices, ['title' => $answer, 'correct' => true]);
                } else {
                    array_push($choices, ['title' => $answer, 'correct' => false]);
                }
            }
            $data['choices'] = json_encode($choices);
        } elseif ($data['type'] == 'true_false') {
            $data['choices'] = json_encode(['correct_val' => $request->correct_answer]);
        }
        if ($request->hasFile('image')) {
            $data['picture'] = ImageService::storeQuestionImage($request->image);
        }
        BankQuestion::create($data);
        session()->flash('success', __('site.bank_question_created'));
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BankQuestion $question
     * @param BankGroup $group
     * @return Application|Factory|View|void
     */
    public function edit(BankGroup $group, BankQuestion $question)
    {
        return view('teacher.questions_bank.questions.edit', compact('question', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BankQuestionRequest $request
     * @param $group
     * @param BankQuestion $question
     * @return RedirectResponse
     */
    public function update(BankQuestionRequest $request, $group, BankQuestion $question)
    {
        $data = $request->validated();
        $data['group_id'] = $group;
        if ($data['type'] == 'mcq') {
            $choices = [];
            foreach ($request['answers'] as $key => $answer) {
                if ($request->correct_answer - 1 == $key) {
                    array_push($choices, ['title' => $answer, 'correct' => true]);
                } else {
                    array_push($choices, ['title' => $answer, 'correct' => false]);
                }
            }
            $data['choices'] = json_encode($choices);
        } elseif ($data['type'] == 'true_false') {
            $data['choices'] = json_encode(['correct_val' => $request->correct_answer]);
        }
        if ($request->hasFile('image')) {
            if ($question->picture) {
                ImageService::deleteQuestionImage($question->picture);
            }
            $data['picture'] = ImageService::storeQuestionImage($request->image);
        }
        $question->update($data);
        session()->flash('success', __('site.bank_question_updated'));
        return redirect()->route('teacher.questions_bank.groups.questions.index', ['group' => $group]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BankGroup $group
     * @param BankQuestion $question
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(BankGroup $group, BankQuestion $question)
    {
        if ($question->picture) {
            if (ImageService::deleteQuestionImage($question->picture)) {
                $question->delete();
            } else {
                session()->flash('error', __('site.bank_question_delete_error'));
                return redirect()->back();
            }
        } else {
            $question->delete();
        }
        session()->flash('success', __('site.bank_question_deleted'));
        return redirect()->back();
    }
}

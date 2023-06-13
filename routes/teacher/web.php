<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::prefix('dashboard/teacher')->name('teacher.')->middleware(['auth', 'role:teacher'])->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        //list courses
        Route::get('courses', 'CoursesController@index')->name('courses.index');

        //creating course
        Route::get('courses/create', 'CoursesController@create')->name('courses.create');
        Route::get('courses/{course}', 'CoursesController@show')->name('courses.show');
        Route::post('courses/first_step', 'CoursesController@first_step')->name('courses.first_step');

        //sections step
        Route::get('courses/{course}/sections', 'CourseSectionsController@index')->name('courses.sections.index');
        Route::post('courses/{course}/sections', 'CourseSectionsController@store')->name('courses.sections.store');
        Route::get('courses/{course}/sections/create', 'CourseSectionsController@create')->name('courses.sections.create');
        Route::get('courses/{course}/sections/{section}/edit', 'CourseSectionsController@edit')->name('courses.sections.edit');
        Route::put('courses/{course}/sections/{section}/update', 'CourseSectionsController@update')->name('courses.sections.update');
        Route::delete('courses/{course}/sections/{section}/destroy', 'CourseSectionsController@destroy')->name('courses.sections.destroy');

        Route::get('courses/{course}/create_second', 'CoursesController@create_second')->name('courses.create_second');


        Route::post('courses/{course}/second_step', 'CoursesController@second_step')->name('courses.second_step');
        Route::get('courses/{course}/create_third_step', 'CoursesController@create_third')->name('courses.create_third');
        Route::post('courses/{course}/third_step', 'CoursesController@third_step')->name('courses.third_step');
        Route::get('courses/{course}/complete', 'CoursesController@complete_data')->name('courses.complete');
        Route::post('lessons/{course}/ajax', 'LessonsController@store_ajax')->name('lessons.store_ajax');
        Route::post('lessons/remove_ajax', 'LessonsController@remove_ajax')->name('lessons.remove_ajax');

        //updating course
        Route::get('courses/{course}/edit_basic_info', 'CoursesController@edit_basic_info')->name('courses.edit_basic_info');
        Route::patch('courses/{course}/update_basic_info', 'CoursesController@update_basic_info')->name('courses.update_basic_info');
        Route::get('courses/{course}/add_lessons', 'CoursesController@add_lessons')->name('courses.add_lessons');

        //course resources
        Route::get('courses/{course}/resources', 'ResourcesController@index')->name('courses.resources.index');
        Route::get('courses/{course}/resources/create', 'ResourcesController@create')->name('courses.resources.create');
        Route::post('courses/{course}/resources', 'ResourcesController@store')->name('courses.resources.store');
        Route::delete('courses/{course}/resources/{resource}/destroy', 'ResourcesController@destroy')->name('courses.resources.destroy');
        Route::get('courses/{course}/resources/{resource}/download', 'ResourcesController@download')->name('courses.resources.download');

        //course attendance report
        Route::get('courses/{course}/attendance_report', 'CoursesController@attendance_report')->name('courses.attendance_report');


        //wallet
        Route::get('wallet', 'WalletController@index')->name('wallet.index');
        Route::post('wallet/bank_withdraw', 'WalletController@bankWithdraw')->name('wallet.bankWithdraw');
        Route::post('wallet/vodafone_withdraw', 'WalletController@vodafoneWithdraw')->name('wallet.vodafoneWithdraw');

        //quizzes
        Route::get('courses/{course}/quizzes', 'QuizzesController@index')->name('courses.quizzes.index');
        Route::get('courses/{course}/quizzes/first_step_create', 'QuizzesController@first_step_create')->name('courses.quizzes.first_step_create');
        Route::post('courses/{course}/quizzes/first_step_store', 'QuizzesController@first_step_store')->name('courses.quizzes.first_step_store');
        Route::get('courses/{course}/quizzes/create', 'QuizzesController@create')->name('courses.quizzes.create');
        Route::post('courses/{course}/quizzes', 'QuizzesController@store')->name('courses.quizzes.store');
        Route::get('courses/{course}/quizzes/{quiz}/choose_questions_method', 'QuizzesController@choose_questions_method')->name('courses.quizzes.choose_questions_method');
        Route::post('courses/{course}/quizzes/{quiz}/redirect_after_choose_method', 'QuizzesController@redirect_after_choose_method')->name('courses.quizzes.redirect_after_choose_method');
        Route::get('courses/{course}/quizzes/{quiz}/other_quizzes', 'QuizzesController@show_other_quizzes')->name('courses.quizzes.show_other_quizzes');
        Route::post('courses/{course}/quizzes/{quiz}/copy', 'QuizzesController@generate_quiz_from_other_quiz_questions')->name('courses.quizzes.copy');
        Route::get('courses/{course}/quizzes/{quiz}/show_bank_groups', 'QuizzesController@show_bank_groups')->name('courses.quizzes.show_bank_groups');
        Route::post('courses/{course}/quizzes/{quiz}/generate_questions_from_bank', 'QuizzesController@generate_questions_from_bank')->name('courses.quizzes.generate_questions_from_bank');

        Route::get('courses/{course}/quizzes/{quiz}/sections', 'QuizzesController@create_sections')->name('courses.quizzes.create_sections');
        Route::post('courses/{course}/quizzes/{quiz}/sections', 'QuizzesController@store_sections')->name('courses.quizzes.store_sections');
        Route::get('courses/{course}/quizzes/{quiz}/questions', 'QuizzesController@create_questions')->name('courses.quizzes.create_questions');
        Route::get('courses/{course}/quizzes/{quiz}/finish', 'QuizzesController@finish_quiz')->name('courses.quizzes.finish_quiz');
        Route::delete('courses/{course}/quizzes/{quiz}/destroy', 'QuizzesController@destroy')->name('courses.quizzes.destroy');
        Route::get('courses/{course}/quizzes/{quiz}/complete', 'QuizzesController@complete_data')->name('courses.quizzes.complete');
        Route::get('courses/{course}/quizzes/{quiz}/statistics', 'QuizzesController@statistics')->name('courses.quizzes.statistics');

        //quiz questions
        Route::post('courses/{course}/quizzes/{quiz}/questions', 'QuizQuestionController@store_question')->name('courses.quizzes.store_question');
        Route::get('courses/{course}/quizzes/{quiz}/questions/{question}/edit', 'QuizQuestionController@edit_question')->name('courses.quizzes.edit_question');
        Route::put('courses/{course}/quizzes/{quiz}/questions/{question}/update', 'QuizQuestionController@update_question')->name('courses.quizzes.update_question');
        Route::delete('courses/{course}/quizzes/{quiz}/questions/{question}/delete', 'QuizQuestionController@delete_question')->name('courses.quizzes.delete_question');


        //quiz answers
        Route::get('courses/{course}/quizzes/{quiz}/answers', 'QuizzesController@quiz_answers')->name('courses.quizzes.answers');
        Route::get('courses/{course}/quizzes/{quiz}/answers/download', 'QuizzesController@quiz_answers_download')->name('courses.quizzes.answers.download');
        Route::get('courses/{course}/quizzes/{quiz}/results/{quiz_attempt}', 'QuizzesController@show_results')->name('courses.quizzes.results');
        Route::get('courses/{course}/quizzes/{quiz}/answers/{quiz_attempt}', 'QuizzesController@quiz_answer')->name('courses.quizzes.answer');
        Route::post('courses/{course}/quizzes/{quiz}/answers/{quiz_attempt}', 'QuizzesController@submit_final_mark')->name('courses.quizzes.submit_final_mark');


        //assignments
        Route::get('courses/{course}/assignments', 'AssignmentsController@index')->name('courses.assignments.index');
        Route::get('courses/{course}/assignments/first_step_create', 'AssignmentsController@first_step_create')->name('courses.assignments.first_step_create');
        Route::post('courses/{course}/assignments/first_step_store', 'AssignmentsController@first_step_store')->name('courses.assignments.first_step_store');
        Route::get('courses/{course}/assignments/create', 'AssignmentsController@create')->name('courses.assignments.create');
        Route::post('courses/{course}/assignments', 'AssignmentsController@store')->name('courses.assignments.store');
        Route::get('courses/{course}/assignments/{assignment}/choose_questions_method', 'AssignmentsController@choose_questions_method')->name('courses.assignments.choose_questions_method');
        Route::post('courses/{course}/assignments/{assignment}/redirect_after_choose_method', 'AssignmentsController@redirect_after_choose_method')->name('courses.assignments.redirect_after_choose_method');
        Route::get('courses/{course}/assignments/{assignment}/other_assignments', 'AssignmentsController@show_other_assignments')->name('courses.assignments.show_other_assignments');
        Route::post('courses/{course}/assignments/{assignment}/copy', 'AssignmentsController@generate_assignment_from_other_assignment_questions')->name('courses.assignments.copy');
        Route::get('courses/{course}/assignments/{assignment}/show_bank_groups', 'AssignmentsController@show_bank_groups')->name('courses.assignments.show_bank_groups');
        Route::post('courses/{course}/assignments/{assignment}/generate_questions_from_bank', 'AssignmentsController@generate_questions_from_bank')->name('courses.assignments.generate_questions_from_bank');

        Route::get('courses/{course}/assignments/{assignment}/sections', 'AssignmentsController@create_sections')->name('courses.assignments.create_sections');
        Route::post('courses/{course}/assignments/{assignment}/sections', 'AssignmentsController@store_sections')->name('courses.assignments.store_sections');
        Route::get('courses/{course}/assignments/{assignment}/questions', 'AssignmentsController@create_questions')->name('courses.assignments.create_questions');
        Route::get('courses/{course}/assignments/{assignment}/finish', 'AssignmentsController@finish_assignment')->name('courses.assignments.finish_assignment');
        Route::delete('courses/{course}/assignments/{assignment}/destroy', 'AssignmentsController@destroy')->name('courses.assignments.destroy');
        Route::get('courses/{course}/assignments/{assignment}/complete', 'AssignmentsController@complete_data')->name('courses.assignments.complete');

        //assignment questions
        Route::post('courses/{course}/assignments/{assignment}/questions', 'AssignmentsQuestionController@store_question')->name('courses.assignments.store_question');
        Route::get('courses/{course}/assignments/{assignment}/questions/{question}/edit', 'AssignmentsQuestionController@edit_question')->name('courses.assignments.edit_question');
        Route::put('courses/{course}/assignments/{assignment}/questions/{question}/update', 'AssignmentsQuestionController@update_question')->name('courses.assignments.update_question');
        Route::delete('courses/{course}/assignments/{assignment}/questions/{question}/delete', 'AssignmentsQuestionController@delete_question')->name('courses.assignments.delete_question');


        //assignment answers
        Route::get('courses/{course}/assignments/{assignment}/answers', 'AssignmentsController@assignment_answers')->name('courses.assignments.answers');
        Route::get('courses/{course}/assignments/{assignment}/results/{assignment_attempt}', 'AssignmentsController@show_results')->name('courses.assignments.results');
        Route::get('courses/{course}/assignments/{assignment}/answers/{assignment_attempt}', 'AssignmentsController@assignment_answer')->name('courses.assignments.answer');
        Route::post('courses/{course}/assignments/{assignment}/answers/{assignment_attempt}', 'AssignmentsController@submit_final_mark')->name('courses.assignments.submit_final_mark');


        //Questions Bank Groups
        Route::get('questions-bank-groups', 'QuestionBankGroupsController@index')->name('questions_bank.groups.index');
        Route::post('questions-bank-groups/create', 'QuestionBankGroupsController@store')->name('questions_bank.groups.create');
        Route::get('questions-bank-groups/{group}/edit', 'QuestionBankGroupsController@edit')->name('questions_bank.groups.edit');
        Route::put('questions-bank-groups/{group}/update', 'QuestionBankGroupsController@update')->name('questions_bank.groups.update');
        Route::delete('questions-bank-groups/{group}/destroy', 'QuestionBankGroupsController@destroy')->name('questions_bank.groups.delete');

        //Questions Bank
        Route::get('questions-bank-groups/{group}/questions-bank', 'QuestionBankQuestionsController@index')->name('questions_bank.groups.questions.index');
        Route::post('questions-bank-groups/{group}/questions-bank/create', 'QuestionBankQuestionsController@store')->name('questions_bank.groups.questions.create');
        Route::get('questions-bank-groups/{group}/questions-bank/{question}/edit', 'QuestionBankQuestionsController@edit')->name('questions_bank.groups.questions.edit');
        Route::put('questions-bank-groups/{group}/questions-bank/{question}/edit', 'QuestionBankQuestionsController@update')->name('questions_bank.groups.questions.update');
        Route::delete('questions-bank-groups/{group}/questions-bank/{question}/destroy', 'QuestionBankQuestionsController@destroy')->name('questions_bank.groups.questions.delete');

        //announcements
        Route::get('courses/{course}/announcements', 'AnnouncementsController@index')->name('courses.announcements.index');
        Route::post('courses/{course}/announcements', 'AnnouncementsController@store')->name('courses.announcements.store');

        //qas
        Route::get('courses/{course}/qa', 'QuestionsAnswersController@index')->name('courses.qas.index');
        Route::get('courses/{course}/qa/{qa}/answer', 'QuestionsAnswersController@answer_page')->name('courses.qas.answer_page');
        Route::post('courses/{course}/qa/{qa}/answer', 'QuestionsAnswersController@answer')->name('courses.qas.answer');
        Route::get('courses/{course}/qa/{qa}/answer/edit', 'QuestionsAnswersController@edit')->name('courses.qas.edit');
        Route::put('courses/{course}/qa/{qa}/answer/update', 'QuestionsAnswersController@update')->name('courses.qas.update');

        //notifications
        Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
        Route::get('mark_all_notifications_as_read', 'NotificationsController@mark_as_read')->name('notifications.mark_as_read');

        //profile
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::put('profile_picture', 'ProfileController@upload_profile_picture')->name('profile.upload_picture');
        Route::put('profile', 'ProfileController@update')->name('profile.update');
        Route::put('change_password', 'ProfileController@update_password')->name('profile.change_password');


    });
});

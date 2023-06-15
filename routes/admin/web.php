<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::prefix('dashboard/admin')->name('admin.')->group(function () {
        Auth::routes(['register' => false]);
    });
    Route::prefix('dashboard/admin')->name('admin.')->middleware(['admin.auth', 'role:admin'])->group(function () {
        Route::get('/', function () {
            $total_teachers = \App\Models\User::whereRoleIs('teacher')->count();
            $total_courses = \App\Models\Course::where('status', \App\Models\Course::STATUS_PUBLISHED)->count();
            $total_students = \App\Models\User::whereRoleIs('student')->orWhereRoleIs('limted_student')->count();
            return view('admin.home', compact('total_teachers', 'total_courses', 'total_students'));
        })->name('home');

        Route::resource('categories', 'CategoryController')->except(['show']);
        Route::get('courses', 'CoursesController@index')->name('courses.index');
        Route::get('courses/{course}', 'CoursesController@show')->name('courses.show');
        Route::delete('courses/destroy', 'CoursesController@destroy')->middleware('password.confirm')->name('courses.destroy');
        Route::put('courses/{course}/approve', 'CoursesController@approve')->name('courses.approve');
        Route::put('courses/reject', 'CoursesController@reject')->name('courses.reject');
        Route::get('courses/{course}/students_management', 'CoursesController@generate_students_page')->middleware('publishedCourseOnly')->name('courses.generate_students_page');
        Route::get('courses/{course}/generated_students', 'CoursesController@generated_students')->middleware('publishedCourseOnly')->name('courses.generated_students');
        Route::post('courses/{course}/generate_students', 'CoursesController@generate_students')->middleware('publishedCourseOnly')->name('courses.generate_students');
        Route::get('courses/{course}/download_students', 'CoursesController@download_students')->middleware('publishedCourseOnly')->name('courses.download_students');
        Route::post('courses/{course}/upload_students', 'CoursesController@upload_students')->middleware('publishedCourseOnly')->name('courses.upload_students');
        Route::post('courses/{course}/delete_all_generated_students', 'CoursesController@delete_all_generated_students')->middleware('publishedCourseOnly')->name('courses.delete_all_generated_students');
        Route::post('courses/{course}/block_all_generated_students', 'CoursesController@block_all_generated_students')->middleware('publishedCourseOnly')->name('courses.block_all_generated_students');
        Route::post('courses/{course}/unblock_all_generated_students', 'CoursesController@unblock_all_generated_students')->middleware('publishedCourseOnly')->name('courses.unblock_all_generated_students');


        Route::get('courses/{course}/groups', 'CourseGroupsController@index')->middleware('publishedCourseOnly')->name('courses.groups');
        Route::get('courses/{course}/groups/{group}/students', 'CourseGroupsController@students')->middleware('publishedCourseOnly')->name('courses.groups.students');
        Route::post('courses/{course}/groups/{group}/delete_all_students', 'CourseGroupsController@delete_all_students')->middleware('publishedCourseOnly')->name('courses.groups.delete_all_students');
        Route::post('courses/{course}/groups/{group}/block_all_students', 'CourseGroupsController@block_all_students')->middleware('publishedCourseOnly')->name('courses.groups.block_all_students');
        Route::post('courses/{course}/groups/{group}/unblock_all_students', 'CourseGroupsController@unblock_all_students')->middleware('publishedCourseOnly')->name('courses.groups.unblock_all_students');
        Route::delete('courses/{course}/groups/{group}/destroy', 'CourseGroupsController@destroy')->middleware('publishedCourseOnly')->name('courses.groups.destroy');


        Route::get('become_teacher_requests', 'TeacherRequestController@index')->name('become_teacher_requests.index');
        Route::get('become_teacher_requests/{request}/approve/{user}', 'TeacherRequestController@approve')->name('become_teacher_requests.approve');
        Route::get('become_teacher_requests/{request}/reject/{user}', 'TeacherRequestController@reject')->name('become_teacher_requests.reject');

        Route::get('recharge_requests', 'RechargeRequestsController@index')->name('recharge_requests.index');
        Route::get('recharge_requests/{request}/approve', 'RechargeRequestsController@approve')->name('recharge_requests.approve');

        Route::get('withdrawal_requests', 'WithdrawalRequestsController@index')->name('withdrawal_requests.index');
        Route::get('withdrawal_requests/{withdrawRequest}/approve', 'WithdrawalRequestsController@approve')->name('withdrawal_requests.approve');
        Route::put('withdrawal_requests/{withdrawRequest}/reject', 'WithdrawalRequestsController@reject')->name('withdrawal_requests.reject');

        Route::get('course/{course}/students/{student}/edit', 'StudentsController@edit')->name('courses.students.edit');
        Route::put('course/{course}/students/{student}/update', 'StudentsController@update')->name('courses.students.update');
        Route::get('students/{student}/block', 'StudentsController@block')->name('students.block');
        Route::get('students/{student}/unblock', 'StudentsController@unblock')->name('students.unblock');
        Route::delete('students/{student}/destroy', 'StudentsController@destroy')->name('students.destroy');


        Route::get('course/{course}/students/edit_bulk', 'StudentsController@edit_bulk')
            ->name('courses.students.edit_bulk');

        Route::post('course/{course}/students/update_group_bulk', 'StudentsController@update_group_bulk')
            ->name('courses.students.update_group_bulk');

        Route::post('course/{course}/students/delete_bulk', 'StudentsController@delete_bulk')
            ->name('courses.students.delete_bulk');

        Route::post('course/{course}/students/block_bulk', 'StudentsController@block_bulk')
            ->name('courses.students.block_bulk');

        Route::post('course/{course}/students/unblock_bulk', 'StudentsController@unblock_bulk')
            ->name('courses.students.unblock_bulk');

        Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
        Route::get('mark_all_notifications_as_read', 'NotificationsController@mark_as_read')->name('notifications.mark_as_read');

        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::put('profile_picture', 'ProfileController@upload_profile_picture')->name('profile.upload_picture');
        Route::put('profile', 'ProfileController@update')->name('profile.update');
        Route::put('change_password', 'ProfileController@update_password')->name('profile.change_password');

        Route::get('website_settings', 'SettingsController@index')->name('settings.index');
        Route::put('general_settings', 'SettingsController@update_general_settings')->name('settings.update_general_settings');
        Route::put('website_pictures', 'SettingsController@update_website_pictures')->name('settings.update_website_pictures');
        Route::put('update_code_status', 'SettingsController@update_animated_code_status')->name('settings.update_animated_code_status');
        Route::put('update_mobile_links', 'SettingsController@update_mobile_links')->name('settings.update_mobile_links');
        Route::put('update_social_links', 'SettingsController@update_social_links')->name('settings.update_social_links');

        Route::get('contact', 'ContactUsController@index')->name('contact.index');
        Route::get('contact/{contact}', 'ContactUsController@show')->name('contact.show');

    });
});

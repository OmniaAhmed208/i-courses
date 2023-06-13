<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Auth::routes(['verify' => true]);

    Route::get('/', 'HomeController@index')->middleware('limited_student')->name('home');
    Route::get('/become-teacher', 'TeacherRequestsController@index')->middleware(['auth', 'verified', 'check_banned', 'limited_student'])->name('become-teacher.index');
    Route::post('/become-teacher', 'TeacherRequestsController@store')->middleware(['auth', 'verified', 'check_banned', 'limited_student'])->name('become-teacher.store');

    Route::get('/search', 'CoursesController@search')->middleware('limited_student')->name('courses.seach');
    Route::get('/live_search', 'CoursesController@live_search')->middleware('limited_student')->name('courses.live_search');

    Route::get('courses', 'CoursesController@index')->middleware('limited_student')->name('courses.index');
    Route::get('my_courses', 'CoursesController@my_courses')->middleware('limited_student')->name('courses.my_courses');
    Route::get('courses/{course}', 'CoursesController@show')->name('courses.show');
    Route::get('/courses/{course}/study', 'CoursesController@study')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.study');
    Route::get('/courses/{course}/resources/{resource}/download', 'CoursesController@download')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.resources.download');
    Route::get('courses/{course}/reviews', 'CommentsController@index')->middleware(['auth', 'check_banned', 'limited_student', 'role:student|limited_student'])->name('courses.reviews.index');
    Route::post('courses/{course}/post_review', 'CommentsController@post_review')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'limited_student', 'role:student|limited_student'])->name('courses.post_review');
    Route::get('courses/{course}/add_to_cart', 'CartController@add')->middleware(['auth', 'verified', 'check_banned', 'limited_student', 'role:student'])->name('courses.add_to_cart');
    Route::get('courses/{course}/quizzes/{quiz}', 'QuizzesController@show')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.quizzes.show');
    Route::post('courses/{course}/quizzes/{quiz}/attempt', 'QuizzesController@attempt')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.quizzes.attempt');
    Route::get('courses/{course}/quizzes/{quiz}/show_results/{quiz_attempt}', 'QuizzesController@showResults')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.quizzes.showResults');


    Route::get('courses/{course}/assignments/{assignment}', 'AssignmentsController@show')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.assignments.show');
    Route::post('courses/{course}/assignments/{assignment}/submit_single_question/{question}', 'AssignmentsController@submit_single_question')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.assignments.submit_single_question');
    Route::get('courses/{course}/assignments/{assignment}/show_results/{assignment_attempt}', 'AssignmentsController@showResults')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.assignments.showResults');


    Route::post('courses/{course}/qa/ask', 'QuestionsAnswersController@ask')->middleware(['auth', 'check_banned', 'studentBoughtCourse', 'role:student|limited_student'])->name('courses.qa.ask');


    Route::get('/cart', 'CartController@index')->middleware(['auth', 'verified', 'check_banned', 'limited_student', 'role:student'])->name('cart.index');
    Route::get('/cart/{cartItem}/delete', 'CartController@destroy')->middleware(['auth', 'verified', 'check_banned', 'limited_student', 'role:student'])->name('cart.destroy');
    Route::post('/cart/checkout', 'OrdersController@checkout')->middleware(['auth', 'verified', 'check_banned', 'limited_student', 'role:student'])->name('orders.checkout');

    Route::get('wallet', 'WalletController@index')->middleware(['auth', 'verified', 'check_banned', 'limited_student', 'role:student'])->name('wallet.index');
    Route::post('wallet/recharge', 'WalletController@create_request')->middleware(['auth', 'verified', 'check_banned', 'limited_student', 'role:student'])->name('wallet.recharge');

    Route::get('banned', 'BannedController@index')->name('banned');

    Route::get('lessons/{lesson}/users/{user}/is_available', 'CoursesController@is_lesson_available')->middleware(['auth', 'verified'])->name('courses.lessons.is_available');
    Route::post('lessons/student_watched_lesson', 'CoursesController@student_watched_lesson')->middleware(['auth', 'verified'])->name('courses.lessons.student_watched_lesson');
    Route::post('lessons/student_clicked_lesson', 'CoursesController@student_clicked_lesson')->middleware(['auth', 'verified'])->name('courses.lessons.student_clicked_lesson');


    Route::get('notifications', 'NotificationsController@index')->middleware('auth')->name('notifications.index');
    Route::get('mark_all_notifications_as_read', 'NotificationsController@mark_as_read')->middleware('auth')->name('notifications.mark_as_read');


    Route::get('profile', 'ProfileController@index')->middleware('auth')->name('profile');
    Route::put('profile_picture', 'ProfileController@upload_profile_picture')->middleware('auth')->name('profile.upload_picture');
    Route::put('profile', 'ProfileController@update')->middleware('auth')->name('profile.update');
    Route::put('change_password', 'ProfileController@update_password')->middleware('auth')->name('profile.change_password');

    Route::get('webview/lessons/{lesson}/{user?}', 'WebviewController@index');

    Route::get('contact', 'ContactUsController@index')->name('contact.index');
    Route::post('contact', 'ContactUsController@store')->middleware(['honey'])->name('contact.store');

    Route::get('about', 'AboutController@index')->name('about.index');
    Route::get('about_teacher', 'AboutController@about_teacher')->name('about.teacher');

    Route::get('privacy', function () {
        return '<h1>Privacy Policy</h1>';
    });
});

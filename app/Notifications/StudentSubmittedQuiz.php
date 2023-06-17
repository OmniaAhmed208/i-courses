<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentSubmittedQuiz extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course_slug;
    protected $quiz;
    protected $attempt;

    /**
     * Create a new notification instance.
     *
     * @param $course_slug
     * @param $quiz
     * @param $attempt
     */
    public function __construct($course_slug, $quiz, $attempt)
    {
        $this->course_slug = $course_slug;
        $this->quiz = $quiz;
        $this->attempt = $attempt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'redirect_url' => route('teacher.courses.quizzes.answer', ['course' => $this->course_slug, 'quiz' => $this->quiz->id, 'quiz_attempt' => $this->attempt->id]),
            'student_name' => $this->attempt->student->name,
            'quiz_name' => $this->quiz->name,
            'icon' => 'las la-check-double',
            'color' => 'bg-color-1',
        ];
    }
}

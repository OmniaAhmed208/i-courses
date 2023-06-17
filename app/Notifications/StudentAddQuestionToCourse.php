<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAddQuestionToCourse extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course;
    protected $student_name;
    protected $qa;

    /**
     * Create a new notification instance.
     *
     * @param $course
     * @param $student_name
     * @param $qa
     */
    public function __construct($course, $student_name, $qa)
    {
        $this->course = $course;
        $this->student_name = $student_name;
        $this->qa = $qa;
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
            'redirect_url' => route('teacher.courses.qas.answer_page', ['course' => $this->course->slug, 'qa' => $this->qa->id]),
            'student_name' => $this->student_name,
            'course_name' => $this->course->getTranslation('title', 'en'),
            'icon' => 'las la-question-circle',
            'color' => 'bg-color-2',
        ];
    }
}

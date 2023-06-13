<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentAnswerAllAssignmentQuestions extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course_slug;
    protected $assignment;
    protected $attempt;

    /**
     * Create a new notification instance.
     *
     * @param $course_slug
     * @param $assignment
     * @param $attempt
     */
    public function __construct($course_slug, $assignment, $attempt)
    {
        $this->assignment = $assignment;
        $this->attempt = $attempt;
        $this->course_slug = $course_slug;
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
            'redirect_url' => route('teacher.courses.assignments.answer', ['course' => $this->course_slug, 'assignment' => $this->assignment->id, 'assignment_attempt' => $this->attempt->id]),
            'student_name' => $this->attempt->student->name,
            'assignment_name' => $this->assignment->name,
            'icon' => 'las la-check-double',
            'color' => 'bg-color-4',
        ];
    }
}

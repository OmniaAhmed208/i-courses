<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentAnswerHasBeenReviewed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course_slug;
    protected $attempt;
    protected $assignment;

    /**
     * Create a new notification instance.
     *
     * @param $course_slug
     * @param $attempt
     * @param $assignment
     */
    public function __construct($course_slug, $attempt, $assignment)
    {
        $this->course_slug = $course_slug;
        $this->attempt = $attempt;
        $this->assignment = $assignment;
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
            'redirect_url' => route('courses.assignments.showResults', ['course' => $this->course_slug, 'assignment' => $this->assignment->id, 'assignment_attempt' => $this->attempt->id]),
            'assignment_name' => $this->assignment->name,
            'icon' => 'las la-check-double',
            'color' => 'bg-color-1',
        ];
    }
}

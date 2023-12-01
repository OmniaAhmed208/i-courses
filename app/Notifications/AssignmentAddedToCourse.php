<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignmentAddedToCourse extends Notification implements ShouldQueue
{
    use Queueable;

    protected $assignment_name;
    protected $course;

    /**
     * Create a new notification instance.
     *
     * @param $course
     * @param $assignment_name
     */
    public function __construct($course, $assignment_name)
    {
        $this->assignment_name = $assignment_name;
        $this->course = $course;
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
            'redirect_url' => route('courses.study', $this->course->slug),
            'assignment_name' => $this->assignment_name,
            'icon' => 'las la-sticky-note',
            'color' => 'bg-color-4',
        ];
    }
}

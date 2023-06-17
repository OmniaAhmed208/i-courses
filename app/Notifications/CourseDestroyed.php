<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseDestroyed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course_name;

    /**
     * Create a new notification instance.
     *
     * @param $course_name
     */
    public function __construct($course_name)
    {
        $this->course_name = $course_name;
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
            'redirect_url' => route('teacher.courses.index'),
            'course_name' => $this->course_name,
            'icon' => 'la la-trash-alt',
            'color' => 'bg-color-6',
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InstructorEditAnswer extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course_slug;
    protected $instructor_name;

    /**
     * Create a new notification instance.
     *
     * @param $course_slug
     * @param $instructor_name
     */
    public function __construct($course_slug, $instructor_name)
    {
        $this->course_slug = $course_slug;
        $this->instructor_name = $instructor_name;
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
            'redirect_url' => route('courses.study', $this->course_slug),
            'instructor_name' => $this->instructor_name,
            'icon' => 'las la-edit',
            'color' => 'bg-color-4',
        ];
    }
}

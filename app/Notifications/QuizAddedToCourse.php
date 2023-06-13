<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuizAddedToCourse extends Notification implements ShouldQueue
{
    use Queueable;

    protected $quiz_name;
    protected $course;

    /**
     * Create a new notification instance.
     *
     * @param $course
     * @param $quiz_name
     */
    public function __construct($course, $quiz_name)
    {
        $this->course = $course;
        $this->quiz_name = $quiz_name;
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
            'quiz_name' => $this->quiz_name,
            'icon' => 'las la-pencil-alt',
            'color' => 'bg-color-4',
        ];
    }
}

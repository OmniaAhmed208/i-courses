<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $course;
    protected $reject_note;

    /**
     * Create a new notification instance.
     *
     * @param $course
     * @param $reject_note
     */
    public function __construct($course, $reject_note)
    {
        $this->course = $course;
        $this->reject_note = $reject_note;
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
            'course_name' => $this->course->getTranslation("title", 'en'),
            'rejected_by' => $this->reject_note->admin->name,
            'note' => $this->reject_note->note,
            'icon' => 'la la-times-circle',
            'color' => 'bg-color-3',
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnnouncementNotification extends Notification
{
    use Queueable;

    protected $announcement;
    protected $teacher_name;
    protected $course_slug;

    /**
     * Create a new notification instance.
     *
     * @param $course_slug
     * @param $teacher_name
     * @param $announcement
     */
    public function __construct($course_slug, $teacher_name, $announcement)
    {
        $this->announcement = $announcement;
        $this->teacher_name = $teacher_name;
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
            'redirect_url' => route('courses.study', $this->course_slug),
            'teacher_name' => $this->teacher_name,
            'body' => $this->announcement->body,
            'icon' => 'las la-bullhorn',
            'color' => 'bg-color-2'
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RechargeRequestCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $student;

    /**
     * Create a new notification instance.
     *
     * @param $student
     */
    public function __construct($student)
    {
        $this->student = $student;
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
            'redirect_url' => route('admin.recharge_requests.index'),
            'student_name' => $this->student->name,
            'student_email' => $this->student->email,
            'icon' => 'las la-wallet',
            'color' => 'bg-color-3',

        ];
    }
}

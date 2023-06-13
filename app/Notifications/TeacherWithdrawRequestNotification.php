<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeacherWithdrawRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $teacher_name;
    protected $amount;


    /**
     * Create a new notification instance.
     *
     * @param $teacher_name
     * @param $amount
     */
    public function __construct($teacher_name, $amount)
    {
        $this->teacher_name = $teacher_name;
        $this->amount = $amount;
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
            'redirect_url' => route('admin.withdrawal_requests.index'),
            'teacher_name' => $this->teacher_name,
            'amount' => $this->amount,
            'icon' => 'las la-wallet',
            'color' => 'bg-color-3',
        ];
    }
}

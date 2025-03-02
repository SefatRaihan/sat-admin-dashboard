<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Gmail & Profile Notification
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->notification->title)
            ->line($this->notification->description)
            ->line('Scheduled at: ' . $this->notification->date . ' ' . $this->notification->time)
            ->action('View Notification', url('/notifications'))
            ->line('Thank you!');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->notification->title,
            'description' => $this->notification->description,
            'date' => $this->notification->date,
            'time' => $this->notification->time,
        ];
    }
}


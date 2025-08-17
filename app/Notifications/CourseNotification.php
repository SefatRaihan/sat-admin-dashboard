<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CourseNotification extends Notification
{
    use Queueable;

    protected $course;
    /**
     * Create a new notification instance.
     */
    public function __construct(Course $course)
    {
         $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [$this->course, ['message' => 'Course has been created']];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toBroadcast($notifiable)
    {
        $unreadNotificationCount = $notifiable->notifications()
                                    ->whereNull('read_at')
                                    ->count();
        return new BroadcastMessage([
            // 'data' => [
            //     'ticket_id'           => $this->ticket->id,
            //     'tracking_id'         => $this->ticket->tracking_id,
            //     'message'             => "A new ticket '{$this->ticket->problem_description}' has been created.",
            //     'problem_description' => $this->ticket->problem_description,
            //     'status'              => $this->ticket->status,
            //     'created_at'          => $this->ticket->created_at->toDateTimeString(),
            //     'total_unread'        => $unreadNotificationCount,
            // ],
        ]);
    }
}

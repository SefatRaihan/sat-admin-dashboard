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
        return ['database', 'sms'];
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
        $unreadNotificationCount = $notifiable->notifications()
                            ->whereNull('read_at')
                            ->count();
        return [
                'course_id'    => $this->course->id,
                'code'         => $this->course->code,
                'title'        => $this->course->title,
                'message'      => "The course \"{$this->course->title}\" has been added to the course catalog.",
                'title'        => $this->course->title,
                'status'       => $this->course->status,
                'created_at'   => $this->course->created_at->toDateTimeString(),
                'total_unread' => $unreadNotificationCount,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $unreadNotificationCount = $notifiable->notifications()
                            ->whereNull('read_at')
                            ->count();
        return [
                'course_id'    => $this->course->id,
                'code'         => $this->course->code,
                'title'        => $this->course->title,
                'message'      => "A new course '{$this->course->title}' has been created.",
                'title'        => $this->course->title,
                'status'       => $this->course->status,
                'created_at'   => $this->course->created_at->toDateTimeString(),
                'total_unread' => $unreadNotificationCount,
        ];
    }

    // public function toBroadcast($notifiable)
    // {
    //     $unreadNotificationCount = $notifiable->notifications()
    //                                 ->whereNull('read_at')
    //                                 ->count();
    //     return new BroadcastMessage([
    //         'data' => [
    //             'ticket_id'    => $this->course->id,
    //             'code'         => $this->course->code,
    //             'title'        => $this->course->title,
    //             'message'      => "A new ticket '{$this->course->title}' has been created.",
    //             'title'        => $this->course->title,
    //             'status'       => $this->course->status,
    //             'created_at'   => $this->course->created_at->toDateTimeString(),
    //             'total_unread' => $unreadNotificationCount,
    //         ],
    //     ]);
    // }
    public function toSms($notifiable): string
    {
        return "New course created: {$this->course->title}";
    }
}

<?php

namespace App\Notifications;

use App\Models\Course;
use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
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
        return ['database', 'mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("New Course Created: {$this->course->title}")
                    ->greeting("Hello {$notifiable->name},")
                    ->line("A new course \"{$this->course->title}\" has been added to the catalog.")
                    ->action('View Course', url("/courses/{$this->course->id}"))
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
        $courseUrl = URL::route('student.course.detail', $this->course->id);

        // If route() returns a signed or long URL you want to shorten, use a shortener service.
        return "New course: {$this->course->title}.\n{$courseUrl}";
    }
}

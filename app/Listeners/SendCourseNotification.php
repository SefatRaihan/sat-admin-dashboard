<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Student;
use App\Events\CourseCreate;
use App\Services\SmsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CourseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendCourseNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }


    /**
     * Handle the event.
     */
    public function handle(CourseCreate $event): void
    {
        $course = $event->course;

        // Get all students related to the course audience
        $students = Student::whereHas('audiences', function ($q) use ($course) {
                $q->where('audiences.audience', $course->audience);
            })
            ->whereHas('user') // make sure they have user relation
            ->get();
        // $numbers = $students->pluck('phone')->toArray();
            // dd();

        // $this->smsService->sendSMS($message, $numbers, 'Mubhir');

        // Notify all students User
        Notification::send(
            $students->pluck('user'),  // send to related users, not Student models
            new CourseNotification($course)
        );

        // Optionally notify the course creator as well
        // $course->user->notify(new CourseNotification($course));

        // Log info
        Log::info('Course created notification sent for course ID: ' . $course->id);
    }
}

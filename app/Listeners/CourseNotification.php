<?php

namespace App\Listeners;

use App\Events\CourseCreate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CourseCreate $event): void
    {
        $course = $event->course;
        dd($course);

        // Notify the user about the course creation
        $course->user->notify(new CourseNotification($course));

        // Optionally, you can log or perform additional actions here
        // \Log::info('Course created notification sent for course ID: ' . $course->id);
    }
}

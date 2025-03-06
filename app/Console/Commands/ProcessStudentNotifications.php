<?php

// app/Console/Commands/ProcessStudentNotifications.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudentNotification;
use App\Models\Student;
use App\Notifications\SendStudentNotification;
use Carbon\Carbon;

class ProcessStudentNotifications extends Command
{
    protected $signature = 'notifications:process-student';
    protected $description = 'Process student notifications and insert into notifications table if due';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDateTime = Carbon::now();

        // Find student notifications where date and time are in the past and is_sent is false
        $pendingNotifications = StudentNotification::where('is_sent', false)
            ->whereRaw("CONCAT(date, ' ', time) <= ?", [$currentDateTime])
            ->get();

        foreach ($pendingNotifications as $studentNotification) {
            // Fetch the related student
            $student = Student::find($studentNotification->student_id);
            if (!$student) {
                continue; // Skip if student not found
            }

            // Get the related user (assuming student has a user relationship)
            $user = $student->user;
            if (!$user) {
                continue; // Skip if user not found
            }

            // Send the notification to the notifications table
            $user->notify(new SendStudentNotification(
                $studentNotification->title,
                $studentNotification->description
            ));

            // Mark the student notification as sent
            $studentNotification->update([
                'is_sent' => true,
                'updated_by' => null, // You can set this to an admin user ID if needed
            ]);

            $this->info("Processed student notification ID: {$studentNotification->id}");
        }

        $this->info('Student notifications processed successfully.');
    }
}

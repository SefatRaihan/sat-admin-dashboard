<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudentNotification;
use App\Models\Student;
use App\Notifications\StudentNotification as NotifyStudent;
use Carbon\Carbon;

class SendStudentNotifications extends Command
{
    protected $signature = 'send:student-notifications';
    protected $description = 'Send scheduled student notifications';

    public function handle()
    {
        $notifications = StudentNotification::where('is_sent', false)
            ->whereDate('date', Carbon::today())
            ->whereTime('time', '<=', now()->toTimeString())
            ->get();

        foreach ($notifications as $notification) {
            $student = Student::find($notification->student_id);
            if ($student) {
                $student->notify(new NotifyStudent($notification));
                $notification->update(['is_sent' => true]);
            }
        }

        $this->info('Scheduled notifications sent successfully.');
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\SendCustomNotification;
// use App\Services\SmsService;
use App\Models\Notification;

class NotificationController extends Controller
{
    // protected $smsService;

    // public function __construct(SmsService $smsService)
    // {
    //     $this->smsService = $smsService;
    // }

    public function index()
    {
        $notifications = Notification::latest()->paginate(10);
        return view('backend.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('backend.notifications.create');
    }

    public function sendNotification(Request $request)
    {
        try{
            $request->validate([
                'description' => 'required|string',
                'category' => 'required|string|in:all-members,active-users,inactive-users,blocked-users,unblocked-users,supervisors',
            ]);

            $users = $this->getUsersByCategory($request->category);
            $message = $request->description;

            foreach ($users as $user) {
                $user->notify(new SendCustomNotification($message));
            }

            return redirect()->route('notification.index')->with('success', 'Notifications sent successfully!');
        }catch(QueryException $e){
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function sendSms(Request $request)
    {
        try{
            $request->validate([
                'description' => 'required|string|max:160',
                'category' => 'required|string|in:all-members,active-users,inactive-users,blocked-users,unblocked-users,supervisors',
            ]);

            $users = $this->getUsersByCategory($request->category);
            $message = $request->description;

            foreach ($users as $user) {
                if ($user->phone_number) { // Assuming users have a phone_number column
                    try {
                        $this->smsService->send($user->phone_number, $message);
                    } catch (\Exception $e) {
                        \Log::error('SMS sending failed: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Failed to send SMS to some users.');
                    }
                }
            }

            return redirect()->route('notification.index')->with('success', 'SMS sent successfully!');
        }catch(QueryException $e){
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    // app/Http/Controllers/NotificationController.php
    protected function getUsersByCategory($category)
    {
        switch ($category) {
            case 'all-members':
                // Fetch all users who are either supervisors or students
                return User::whereHas('supervisor')->orWhereHas('student')->get();

            case 'active-users':
                // Fetch users whose related supervisor or student has status = 'active'
                return User::whereHas('supervisor', function ($query) {
                    $query->where('status', 'active');
                })->orWhereHas('student', function ($query) {
                    $query->where('status', 'active');
                })->get();

            case 'inactive-users':
                // Fetch users whose related supervisor or student has status = 'inactive'
                return User::whereHas('supervisor', function ($query) {
                    $query->where('status', 'inactive');
                })->orWhereHas('student', function ($query) {
                    $query->where('status', 'inactive');
                })->get();

            case 'blocked-users':
                // Fetch users whose related supervisor or student has status = 'blocked'
                return User::whereHas('supervisor', function ($query) {
                    $query->where('status', 'blocked');
                })->orWhereHas('student', function ($query) {
                    $query->where('status', 'blocked');
                })->get();

            case 'unblocked-users':
                // Fetch users whose related supervisor or student does NOT have status = 'blocked'
                return User::whereHas('supervisor', function ($query) {
                    $query->where('status', '!=', 'blocked');
                })->orWhereHas('student', function ($query) {
                    $query->where('status', '!=', 'blocked');
                })->get();

            case 'supervisors':
                // Fetch users who are supervisors (regardless of status)
                return User::whereHas('supervisor')->get();

            default:
                return collect([]);
        }
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully!');
    }
}

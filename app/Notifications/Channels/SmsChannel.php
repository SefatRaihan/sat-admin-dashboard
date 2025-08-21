<?php
// app/Notifications/Channels/SmsChannel.php
namespace App\Notifications\Channels;

use App\Services\SmsService;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function __construct(private SmsService $sms) {}

    public function send($notifiable, Notification $notification): void
    {

        if(! method_exists($notification, 'toSms'))
        {
            return;
        }

        $message = $notification->toSms($notifiable);
        $to = method_exists($notifiable, 'routeNotificationForSms') ?
                    $notifiable->routeNotificationForSms($notification) :
                    ($notifiable->phone ?? null);

        if (! $to || ! $message) return;

        $message = $notification->toSms($notifiable);

        $this->sms->sendSMS($message, $to, 'Mubhir');
    }
}

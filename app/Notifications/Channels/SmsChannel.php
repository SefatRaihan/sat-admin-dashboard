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
        $phone = $notifiable->routeNotificationFor('sms');

        if (! $phone) return;

        $message = $notification->toSms($notifiable);

        $this->sms->sendSMS($message, [$phone], 'Mubhir');
    }
}

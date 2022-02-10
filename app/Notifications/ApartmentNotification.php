<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;

class ApartmentNotification extends Notification
{
    use Queueable;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [PusherChannel::class];
    }

    /**
     * Get the platform to send notification
     *
     * @param $notifiable
     * @return PusherMessage
     */
    public function toPushNotification($notifiable): PusherMessage
    {
       return PusherMessage::create()
            ->android()
            ->icon('test')
            ->sound('success')
            ->body("Your  account was approved!")
            ->title('Notification');
    }
}

<?php

namespace App\Notifications\Channels;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramNotificationChannel extends TelegramChannel
{
    /**
     * Build the message for the Telegram notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return TelegramMessage
     */

    public function via($notifiable)
    {
        return ['telegram'];
    }

    // public function __construct($botToken)
    // {
    //     $this->botToken = $botToken;
    // }

    public function buildMessage($notifiable, Notification $notification)
    {
        $borrow = $notifiable->borrow; // Assuming a Borrow model relation

        return (new TelegramMessage)
            ->to($borrow->customer->telegram_chat_id) // Use chat_id from Borrow's customer
            ->content($notification->toMail($notifiable)->render()); // Use rendered email content
    }
}

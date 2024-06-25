<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\Channels\TelegramNotificationChannel;

class BorrowNotification extends Notification
{
    public function via($notifiable)
    {
        return [TelegramNotificationChannel::class];
    }

    public function toMail($notifiable)
    {
        $borrow = $notifiable->borrow; // Assuming a Borrow model relation

        return (new MailMessage)
            ->line('A new borrow has been created!')
            ->line('Borrow details:')
            // ... Add details about the borrow (e.g., item, date)
            ->line('Thank you for using our service!');
    }
}

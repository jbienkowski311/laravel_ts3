<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminUserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the notification message.
     *
     * @return void
     */
    public function message()
    {
        $this->line('The introduction to the notification.')
             ->action('Notification Action', 'https://laravel.com')
             ->line('Thank you for using our application!');
    }
}

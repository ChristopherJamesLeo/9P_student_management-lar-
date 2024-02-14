<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollEmailNotify extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this -> data = $data;
    }


    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting("Thank you apply for " . $this -> data["name"] . " class." )
                    ->line('Your are having at the ' . $this -> data["stage"] . " stage and we are verifying at soon at possible")
                    ->action('Visit Post', $this -> data["url"]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

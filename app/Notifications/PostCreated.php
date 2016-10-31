<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostCreated extends Notification
{
    use Queueable;
    public $message;
    public $url;
    public $notifier;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $url, $notifier)
    {
        $this->message = $message;
        $this->url = $url;
        $this->notifier = $notifier;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'=>$this->message,
            'url'    => $this->url,
            'notifier'=>$this->notifier
        ];
    }
}

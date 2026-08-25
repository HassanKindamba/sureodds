<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPredictionNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $url;
    protected $type;

    public function __construct(
        $title,
        $message,
        $url = '/predictions',
        $type = 'prediction'
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->url = $url;
        $this->type = $type;
    }

    /**
     * Notification channels
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Database notification
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url,
            'type' => $this->type,
        ];
    }
}
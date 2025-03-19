<?php

namespace App\Notifications;

use App\Models\ImportControl;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportFailureNotification extends Notification
{
    use Queueable;

    /**
     * @param ImportControl $importControl
     */
    public function __construct(
        private readonly ImportControl $importControl
    ) {
    }

    /**
     * @param object $notifiable
     *
     * @return string[]
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * @param object $notifiable
     *
     * @return MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Falha na importação, motivo:')
            ->line($this->importControl->description);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Falha na importação',
        ];
    }
}

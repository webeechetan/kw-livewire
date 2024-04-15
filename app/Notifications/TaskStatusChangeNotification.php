<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusChangeNotification extends Notification
{
    use Queueable;

    public $task;
    public $oldStatus;
    public $newStatus;
    public $changedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct($task, $oldStatus, $newStatus, $changedBy)
    {
        $this->task = $task;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->changedBy = $changedBy;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->view('mails.task-status-change', ['task' => $this->task, 'user' => $notifiable, 'oldStatus' => $this->oldStatus, 'newStatus' => $this->newStatus, 'changedBy' => $this->changedBy]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

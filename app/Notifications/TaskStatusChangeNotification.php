<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusChangeNotification extends Notification implements ShouldQueue
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
        if($this->oldStatus == 'completed'){
            $this->oldStatus = 'Completed';
        }else if($this->oldStatus == 'in_progress'){
            $this->oldStatus = 'In Progress';
        }else if($this->oldStatus == 'in_review'){
            $this->oldStatus = 'In Review';
        }else if($this->oldStatus == 'pending'){
            $this->oldStatus = 'Pending';
        }else{
            $this->oldStatus = 'Not Started';
        }

        if($this->newStatus == 'completed'){
            $this->newStatus = 'Completed';
        }else if($this->newStatus == 'in_progress'){
            $this->newStatus = 'In Progress';
        }else if($this->newStatus == 'in_review'){
            $this->newStatus = 'In Review';
        }else if($this->newStatus == 'pending'){
            $this->newStatus = 'Pending';
        }else{
            $this->newStatus = 'Not Started';
        }



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

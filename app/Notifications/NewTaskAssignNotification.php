<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

class NewTaskAssignNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $task; 

    /**
     * Create a new notification instance.
     */
    public function __construct($task)
    {
        $this->task = Task::with('assignedBy')->find($task->id);
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
        Log::info($this->task);
        return (new MailMessage)
                    ->subject('New Task Assigned')
                    ->line('Hey there '. $notifiable->name . ' Chetan assigned you a new task '.$this->task->name)
                    // ->line('Hey there '. $notifiable->name . ' ' .$this->task->assignedBy->name.' assigned you a new task '.$this->task->name)
                    ->action('View Task', url('/tasks/'.$this->task->id))
                    ->line('Thank you for using our application!');
    }

    // public function toSlack($notifiable)
    // {
    //     return (new SlackMessage)
    //     ->from('Ghost', ':ghost:')
    //     ->to('#task_notifications')
    //     ->success()
    //     ->content('Hey there :smile: '.$this->task->assignedBy->name.' assigned you a new task '.$this->task->name)
    //     ->attachment(function ($attachment) {
    //         $attachment->title('Task Details')
    //                     ->fields([
    //                         'Task Name' => $this->task->name,
    //                         'Task Description' => $this->task->description,
    //                         'Assigned By' => $this->task->assignedBy->name,
    //                         'Assigned To' => $this->task->users->pluck('name')->implode(', '),
    //                     ]);
    //         $attachment->footer('KaykeWalk')
    //                     ->timestamp($this->task->created_at);
    //     });

    // }

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

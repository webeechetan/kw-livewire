<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Models\Task;
use App\Models\Scopes\OrganizationScope;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Notification as NotificationModel;

class NewTaskAssignNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;
    public $taskUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct($task, $taskUrl)
    {
        $this->task = $task;
        $this->taskUrl = $taskUrl;
        $this->task->load('assignedBy');
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
        $task = Task::withoutGlobalScope(OrganizationScope::class)->where('id',$this->task->id)->first();
        $assignedBy = User::withoutGlobalScope(OrganizationScope::class)->where('id',$this->task->assigned_by)->first();
        $project = Project::withoutGlobalScope(OrganizationScope::class)->where('id',$this->task->project_id)->first();

        return (new MailMessage)
            ->view('mails.task-assigned-notification-mail', 
            [
                'task' => $task, 
                'user' => $notifiable,
                'assignedBy' => $assignedBy,
                'project' => $project,
                'taskUrl' => $this->taskUrl
            ]
        );

        
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
        ->from('Ghost', ':ghost:')
        ->to('#task_notifications')
        ->success()
        ->content('Hey there :smile: '.$this->task->assignedBy->name.' assigned you a new task '.$this->task->name)
        ->attachment(function ($attachment) {
            $attachment->title('Task Details')
                        ->fields([
                            'Task Name' => $this->task->name,
                            'Task Description' => $this->task->description,
                            'Assigned By' => $this->task->assignedBy->name,
                            'Assigned To' => $this->task->users->pluck('name')->implode(', '),
                        ]);
            $attachment->footer('KaykeWalk')
                        ->timestamp($this->task->created_at);
        });

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
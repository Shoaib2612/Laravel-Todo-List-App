<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Tasks;

class TaskDueNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Tasks $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can also add 'database' for in-app notifications
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Due Soon!')
            ->line('Your task "' . $this->task->title . '" is due soon!')
            ->line('Due Date: ' . $this->task->deadline)
            ->action('View Task', url('/tasks'))
            ->line('Complete it before the deadline!');
}
}
<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        // On envoie uniquement un email
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle tâche assignée : ' . $this->task->title)
                    ->line('Une nouvelle tâche vous a été assignée.')
                    ->line('Titre : ' . $this->task->title)
                    ->line('Priorité : ' . $this->task->priority)
                    ->line('Date limite : ' . \Carbon\Carbon::parse($this->task->due_date)->format('d/m/Y'))
                    ->action('Voir la tâche', url('/tasks/' . $this->task->id))
                    ->line('Merci de votre implication !');
    }
}

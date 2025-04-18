<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;
use App\Notifications\DeadlineApproaching;

class NotifyDeadlineApproaching extends Command
{
    protected $signature = 'notify:deadlines';
    protected $description = 'Notifier les utilisateurs des tâches dont l\'échéance est proche';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        // Récupère les tâches dont la deadline est demain et qui ne sont pas terminées
        $tasks = Task::whereDate('due_date', $tomorrow)
            ->where('status', '!=', 'terminé')
            ->get();

        foreach ($tasks as $task) {
            $task->user->notify(new DeadlineApproaching($task));
        }

        $this->info('Notifications envoyées pour les tâches à échéance demain.');
    }
}

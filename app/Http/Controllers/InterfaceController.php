<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class InterfaceController extends Controller
{
    public function index()
    {
        // Récupérer tous les projets avec un comptage des tâches par statut :
        $projects = Project::withCount([
            'tasks as total_tasks',
            'tasks as todo_tasks' => function ($query) {
                $query->where('status', 'todo');
            },
            'tasks as in_progress_tasks' => function ($query) {
                $query->where('status', 'in_progress');
            },
            'tasks as completed_tasks' => function ($query) {
                $query->where('status', 'completed');
            }
        ])->get();

        // Récupérer des statistiques globales
        $overallTasks = [
            'todo'         => Task::where('status', 'todo')->count(),
            'in_progress'  => Task::where('status', 'in_progress')->count(),
            'completed'    => Task::where('status', 'completed')->count(),
        ];

        return view('interface.index', compact('projects', 'overallTasks'));
    }
}

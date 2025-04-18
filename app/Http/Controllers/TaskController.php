<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Notifications\DeadlineApproaching;
use Illuminate\Http\Request;
use App\Notifications\TaskAssigned;


class TaskController extends Controller
{
    // Afficher toutes les tâches
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Afficher le formulaire pour créer une nouvelle tâche
    public function create()
    {
        $users = User::all(); // On récupère tous les utilisateurs pour les assigner à une tâche
        $projects = Project::all();
        return view('tasks.create', compact('users', 'projects'));
    }

    // Sauvegarder une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,completed',
            'due_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'user_id' => $request->user_id,
            'project_id' => $request->project_id
        ]);
        // Envoi de la notification par email via Mailhog
        $user = User::find($request->user_id);
        $user->notify(new TaskAssigned($task));
        $user->notify(new DeadlineApproaching($task));

        return redirect()->route('tasks.index');
    }

    // Afficher une tâche spécifique
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Afficher le formulaire pour éditer une tâche
    public function edit(Task $task)
    {
        $users = User::all();
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'users', 'projects'));
    }

    // Mettre à jour une tâche
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,completed',
            'due_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'user_id' => $request->user_id,
            'project_id' => $request->project_id
        ]);

        return redirect()->route('tasks.index');
    }

    // Supprimer une tâche
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}

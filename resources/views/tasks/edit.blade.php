@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">  
    <h1>Modifier la Tâche</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $task->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description"  class="form-control" id="description" required>{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Priorité</label>
            <select name="priority"  class="form-control" id="priority" required>
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Basse</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Moyenne</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Haute</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status"  class="form-control" id="status" required>
                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>À faire</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Terminé</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Échéance</label>
            <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" required>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Assigner à</label>
            <select name="user_id" class="form-control" id="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="project_id" class="form-label">Projet :</label>
            <select name="project_id" class="form-control" required>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour la tâche</button>
    </form>
</div>  
@endsection


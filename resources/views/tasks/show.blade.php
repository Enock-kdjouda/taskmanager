@extends('base')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">  
    <h1>Détails de la Tâche</h1>

    <div class="mb-3">
        <strong>Titre :</strong> {{ $task->title }}
    </div>
    <div class="mb-3">
        <strong>Description :</strong> {{ $task->description }}
    </div>
    <div class="mb-3">
        <strong>Priorité :</strong> {{ ucfirst($task->priority) }}
    </div>
    <div class="mb-3">
        <strong>Statut :</strong> {{ ucfirst($task->status) }}
    </div>
    <div class="mb-3">
        <strong>Échéance :</strong> {{ $task->due_date }}
    </div>
    <div class="mb-3">
        <strong>Projet</strong> {{ $task->project->name }}
    </div>

    <div class="mb-3">
        <strong>Assignée à :</strong> {{ $task->user->name }}
    </div>

    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer la tâche</button>
    </form>
</div>    
@endsection

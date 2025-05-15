@extends('base')

@section('content')
<div class="container">    
    <h1>Liste des Tâches</h1>
    <a href="{{ route('tasks.create') }}"  class="btn btn-secondary">Ajouter une tâche</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Priorité</th>
                <th>Statut</th>
                <th>Échéance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-secondary">Voir</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    
@endsection

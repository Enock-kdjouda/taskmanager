@extends('base')

@section('content')
<div class="container">   
    <h1>Créer une Tâche</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Priorité</label>
            <select name="priority" id="priority" class="form-control" required>
                <option value="low">Faible</option>
                <option value="medium">Moyenne</option>
                <option value="high">Haute</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" id="status" class="form-control" required>
                <option value="todo" >À faire</option>
                <option value="in_progress">En cours</option>
                <option value="completed">Terminé</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Échéance</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Assigner à</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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


        <button type="submit" class="btn btn-primary">Créer la tâche</button>
    </form>
</div>     
@endsection

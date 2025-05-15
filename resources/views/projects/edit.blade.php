@extends('base')

@section('content')
    <div class="container">
        <h1>Modifier le projet</h1>

        <form action="{{ route('projects.update', $project) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom du projet</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $project->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection

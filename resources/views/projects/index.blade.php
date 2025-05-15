@extends('base')

@section('content')
    <div class="container">
        <h1>Projets</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-secondary">Créer un projet</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
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

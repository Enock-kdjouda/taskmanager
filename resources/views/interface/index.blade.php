@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">
    <h1>Dashboard</h1>

    <div class="row mb-4">
        
        <h2>Statistiques globales</h2>
        <div class="col-md-4">
            <div class="card text-white" style="background-color: #F38FA9;">
                <div class="card-body">
                    <h5 class="card-title">À faire</h5>
                    <p class="card-text display-4">{{ $overallTasks['todo'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white" style="background-color: #6DBCF4;">
                <div class="card-body">
                    <h5 class="card-title">En cours</h5>
                    <p class="card-text display-4">{{ $overallTasks['in_progress'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white" style="background-color: #84D1CF;">
                <div class="card-body">
                    <h5 class="card-title">Terminées</h5>
                    <p class="card-text display-4">{{ $overallTasks['completed'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h2>Statistiques par Projet</h2>
        
        @foreach($projects as $project)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $project->name }}</strong>
                </div>
                <div class="card-body">
                    <p>Total des Tâches : {{ $project->total_tasks }}</p>
                    <p>À faire : {{ $project->todo_tasks }}</p>
                    <p>En cours : {{ $project->in_progress_tasks }}</p>
                    <p>Terminées : {{ $project->completed_tasks }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Optionnel : Intégrer un graphique avec Chart.js -->
    <div>
        <h2>Graphique Global des Tâches</h2>
        <canvas id="taskChart" width="400" height="200"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<!-- Inclure Chart.js depuis CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Préparer les données pour le graphique global.
    var ctx = document.getElementById('taskChart').getContext('2d');
    var taskChart = new Chart(ctx, {
        type: 'bar', // ou 'pie' 'bar', 'line', etc.
        data: {
            labels: ['À faire', 'En cours', 'Terminées'],
            datasets: [{
                label: 'Tâches Globales',
                data: [
                    @json($overallTasks['todo']),
                    @json($overallTasks['in_progress']),
                    @json($overallTasks['completed'])
               ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>
@endsection

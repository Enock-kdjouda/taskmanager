@extends('base')

@section('content')
<div class="container">
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
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-secondary text-white d-flex align-items-center">
                    <h5 class="mb-0"><strong>{{ $project->name }}</strong></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total des Tâches</span>
                            <span class="badge bg-secondary rounded-pill">{{ $project->total_tasks }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>À faire</span>
                            <span class="badge bg-warning text-dark rounded-pill">{{ $project->todo_tasks }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>En cours</span>
                            <span class="badge bg-info text-dark rounded-pill">{{ $project->in_progress_tasks }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Terminées</span>
                            <span class="badge bg-success rounded-pill">{{ $project->completed_tasks }}</span>
                        </li>
                    </ul>
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
    <!-- Données cachées pour le graphique -->
    <div id="chart-data" 
        data-todo="{{ $overallTasks['todo'] }}" 
        data-in-progress="{{ $overallTasks['in_progress'] }}" 
        data-completed="{{ $overallTasks['completed'] }}" 
        style="display: none;"></div>

    <!-- Canvas pour le graphique -->
    <canvas id="taskChart"></canvas>
@endsection

@section('scripts')
<!-- Inclure Chart.js depuis CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les données depuis l'élément HTML
            var dataElement = document.getElementById('chart-data');
            var todoTasks = parseInt(dataElement.dataset.todo);
            var inProgressTasks = parseInt(dataElement.dataset.inProgress);
            var completedTasks = parseInt(dataElement.dataset.completed);
            
            var ctx = document.getElementById('taskChart').getContext('2d');
            var taskChart = new Chart(ctx, {
                type: 'bar', // ou 'pie' 'bar', 'line', 'doughnut'etc.
                data: {
                    labels: ['À faire', 'En cours', 'Terminées'],
                    datasets: [{
                        label: 'Tâches Globales',
                        data: [todoTasks, inProgressTasks, completedTasks],
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
        });
    </script>
@endsection
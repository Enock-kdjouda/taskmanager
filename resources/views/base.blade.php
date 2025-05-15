<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card {
        transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .list-group-item {
            padding: 0.75rem 1.25rem;
        }
        
        .navbar {
        padding: 0.8rem 0;
    }
    .nav-link {
        font-weight: 500;
        padding: 0.5rem 1rem !important;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    .nav-link.active {
        background: rgba(255, 255, 255, 0.15);
    }
    .dropdown-menu {
        margin-top: 0.5rem;
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    </style>
     
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <svg class="me-2" width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 22V12H15V22" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            TaskManager
        </a>

        <!-- Menu mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('projects.index') ? 'active' : '' }}" href="{{route('projects.index')}}">
                        <i class="fas fa-folder-open me-1"></i>Projets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active' : '' }}" href="{{route('tasks.index')}}">
                        <i class="fas fa-tasks me-1"></i>Tâches
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                @auth
                <div class="dropdown">
                    <a class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center" href="#" role="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @method("delete")
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth

                @guest
                <a href="{{ route('auth.login') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-in-alt me-2"></i>Connexion
                </a>
                @endguest
            </div>
        </div>
    </div>
</nav>
    </div>
    </nav>
  <div class="container">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
        
    @endif
    @yield('content')
  </div>
</body>
@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Venta de Coches')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                Venta de Coches
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Enlaces visibles SOLO para usuarios LOGUEADOS -->
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/nosotros') }}">Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/dondeestamos') }}">Dónde estamos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('dades_consultar') }}">Ver catálogo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('datos_buscar') }}">Buscar coche</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coches_consultar') }}">Consultar Relaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('datos_insertar') }}">Añadir coche</a></li>

                        <!-- Enlaces EXCLUSIVOS si el usuario está autenticado y es 'admin' -->
                        @if(Auth::check() && Auth::user()->rol === 'admin')
                            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="{{ route('datos_modificar') }}">Modificar coche</a></li>
                            <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ route('datos_borrar') }}">Coche vendido</a></li>
                        @endif
                    @endauth
                </ul>
                    
                <!-- Enlaces de autenticación a la derecha -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('registro') }}">Registro</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <span class="navbar-text me-3 text-light">
                                Hola, <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->rol ?? 'usuari' }})
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger btn-sm text-light mt-1" href="{{ route('logout') }}">Cerrar sesión</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        @yield('contingut')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
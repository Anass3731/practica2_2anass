<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Venta de Coches')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <!-- Enlaces de navegación generales -->
                
                <ul class="navbar-nav me-auto">
                     @auth
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/nosotros') }}">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dondeestamos') }}">Donde estamos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('datos_insertar') }}">Añadir coche</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('dades_consultar') }}">Ver catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('datos_buscar') }}">Buscar coche</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('datos_borrar') }}">Coche vendido</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('datos_modificar') }}">Modificar coche</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('coches_consultar') }}">consultar_taules</a></li>
                 @endauth
                </ul>
                    
                <!-- Enlaces de autenticación alineados a la derecha -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registro') }}">Registre</a>
                        </li>
                    @endguest

                    {{-- @auth
                        <li class="nav-item">
                            <span class="navbar-text me-3 text-light">Hola, <strong>{{ Auth::user()->name }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endauth --}}
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
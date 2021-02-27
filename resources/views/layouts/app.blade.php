<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-s barra">            
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="menu">
                        @guest
                            <div class="registro" style="font-size: 18px; margin-right: 10px; font-weight: 500;">
                            
                                <a class="text-white"  href="{{ route('login') }}">{{ __('Login') }}</a>
                            
                            @if (Route::has('register'))
                                
                                <a class="text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                
                            @endif
                            </div>
                        @else
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" 
                                style="font-size: 16px; font-weight: 500;"
                                href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name_apellido }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- Botones para el Rol Chef --}}
                                    @if(Auth::user()->roles=='chef')
                                        <a class="dropdown-item" 
                                            href="{{ route('recetas.index') }}">
                                        {{ 'Administrar' }}
                                        </a>
                                        <a class="dropdown-item" 
                                            href="{{ route('perfiles.show',['perfil' => Auth::user() ->id ]) }}">
                                        {{ 'Ver Perfil' }}
                                        </a>
                                    @endif
                                    
                                    {{-- Botones para el administrador --}}
                                    @if(Auth::user()->roles=='admin')
                                    <a class="dropdown-item" 
                                        href="{{ route('admin.index') }}">
                                        {{ 'Usuarios' }}
                                    </a>
                                    @endif

                                    <a class="dropdown-item" 
                                        href="{{ route('recetas.megusta',['receta' => Auth::user() ->id ]) }}">
                                        {{ 'Me Gusta' }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                </div>   
            </div>
        </nav>
        
                
        <nav class="navbar navbar-expand-md navbar-light categorias-bg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categorias" aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-dark"></span>
                     Categorias
                </button>
                <div class="collapse navbar-collapse " id="categorias">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-auto d-flex justify-content-between">
                        <li class="nav-item"> <a class="nav-link" href="{{ url("/masvotadas") }}"> Más Votadas</a></li>

                        @foreach ($categorias as $categoria)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categorias.show', ['categoriaReceta'=> $categoria->id ]) }}">
                               {{ $categoria->nombre }}
                            </a>                        
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </nav>

        @yield('hero')

        <div class="container" style="min-height: 100vh;">
            <div class="row">
                <div class="py-2 mt-3 col-12">
                @yield('botones')
                </div>
                   
                <main class="py-1 mt-3 col-12">
                    @yield('content')            
                </main>                  
            </div>        
        </div>
        <footer class="footer align-bottom text-center p-3 w-100">
            <div id="scrollUp">▲</div>
        </footer>        
    </div>
    
    @yield('scripts')
</body>
</html>
  
{{-- extendemos de la vista principal --}}
@extends ('layouts.app')

@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias-1">
        <form class="container h-100 w-75" action={{ route('buscar.show') }}>
            <div class="row h-100 align-items-center">
                <div class="col-md-8 texto-buscar">
                    <p class=" col-md-10 display-4">Encuentra una receta para tu próxima comida</p>

                    <input
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar Receta"
                    />
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="container nuevas-recetas">
        <h3 class="titulo-categoria mt-3 mb-2">Últimas Recetas</h3>

        <div class="owl-carousel owl-theme owl-nav">
            @foreach ($nuevas as $nueva)
                <div class="card">
                    <img src="/storage/{{ $nueva->imagen }}" class="card-img-top w-100" alt="imagen receta">

                    <div class="card-body">
                        <h4 class="card-title">{{ Str::title( $nueva->titulo) }}</h4>
                                                                 
                        <p class="card-text">
                            {{ Purify::clean($replaced = str_ireplace($codigoEliminar, [' '], 
                            Str::words( strip_tags( $nueva->preparacion ), 16)) )}} </p>
                        
                        {{-- Div vacio solo para alienar el boton ver --}}
                        <div class="vacio" style="display:flex; flex-grow:1;"></div>

                        <div class="boton">
                            <a href=" {{ route('recetas.show', ['receta' => $nueva->id ]) }}"
                                class="btn d-block mt-1 btn-primary font-weight-normal"
                            >Ver Receta</a>
                        </div>                      
                    </div>                   
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-capitalize mt-2 mb-1">Recetas más Votadas</h2>
        
        <div class="row">
            @foreach($votadas as $receta)
                @include('ui.receta')
            @endforeach
        </div>
    </div>

    @foreach($recetas as $key => $grupo )
        <div class="container">
            <h2 class="titulo-categoria mt-4 mb-1 text-uppercase">
           {{str_replace('-',' ',$key)}} </h2>
            
            <div class="row">
                @foreach($grupo as $recetas)
                    @foreach($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>

    @endforeach

@endsection
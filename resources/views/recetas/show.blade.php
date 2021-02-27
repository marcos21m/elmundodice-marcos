{{-- extendemos de la vista principal --}}
@extends ('layouts.app')
@section('hero')
    <div class="hero-categorias-1">
        <form class="container h-100 w-75" action={{ route('buscar.show') }}>
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu próxima comida</p>

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

    <article class="contenido-receta bg-center bg-white p-1 shadow">     
        <h2 class="text-center mt-3 mb-3">{{$receta->titulo}}</h2>

        <div class="imagen">
            <img src="/storage/{{ $receta->imagen }}" class="imagen-receta w-100">
        </div>

        <div class="receta-meta mt-3 ml-2">
            <p>
                <span class="font-weight-bold text-primary">Categoría: </span>
                <a class="text-dark" href="{{ route('categorias.show', ['categoriaReceta' => $receta->categoria->id ]) }}">
                    <mark> {{$receta->categoria->nombre}}
                </a>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor: </span>
                <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id ]) }}">
                    <mark> {{$receta->autor->name_apellido}}
                </a>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Publicado el:  </span>
                @php
                use Carbon\Carbon;
                $date = Carbon::now();
                $date = $date->format(' d/m/Y');
                echo $date;
                @endphp
            </p>            
        </div> 
        
        <div class="ingredientes ml-2">
            <h3 class="my-3 text-primary">Ingredientes: </h3>
            {!! Purify::clean($replaceIngredientes) !!}
        </div>

        <div class="preparacion ml-2">
            <h3 class="my-3 text-primary">Preparación: </h3>
            {!! Purify::clean($replacePreparacion) !!}
        </div>
        
        <div class="c-md-12">
            <div class="share ml-2 mt-4">
                <p class="text font-weight-bold">Compartir:
                <a href="https://api.whatsapp.com/send?text={{Request::fullUrl()}}" target="_blank" 
                class="whatsapp btn-sm shadow-sm mr-2">Whatsapp
                </a>
                <a class="facebook btn-sm shadow-sm" 
                href="javascript:var dir=window.document.URL;
                var tit=window.document.title;
                var tit2=encodeURIComponent(tit);
                var dir2= encodeURIComponent(dir);
                window.location.href=('http://www.facebook.com/share.php?u='+dir2+'&amp;t='+tit2+'');">
                Facebook
                </a>
                
            </div>
        </div>

        <p>
            
            <a class="text-dark" href="{{ route('recetas.show', ['receta' => $receta->id ]) }}">
                <mark> {{$receta->titulo}}
            </a>
        </p>

        <div class="justify-content-center row text-center">
            <like-button
                receta-id="{{$receta->id}}"
                like="{{$like}}"
                likes="{{$likes}}"
            ></like-button>
        </div>
        <div id="fb-root"></div>
        <div class="fb-comments" data-href="{{Request::fullUrl()}}" data-width="75%" data-numposts="10" data-order-by="time"></div>
    </article> 
@endsection

@section('scripts')
    <script>
        window.fbAsyncInit = function() {
        FB.init({
            appId            : '1807931232716301',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v9.0'
        });
        };
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0&appId=1807931232716301&autoLogAppEvents=1" nonce="rqVdjhCG"></script>
@endsection

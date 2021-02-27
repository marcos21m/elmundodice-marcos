@extends('layouts.app')
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
                    >
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="container">
        <h3 class="titulo-categoria  mt-1 mb-2">
            Resultados para la búsqueda: <mark> {{ $busqueda }}</mark>
        </h3>
        
        <div class="row">
            @foreach ($recetas as $receta)
                @include('ui.receta')
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $recetas->links() }}
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="container bg-white">
            <div class="row">
                <div class="col-xs-12 col-sm-12 w-100">         
                    @if($perfil->imagen)
                    <img src="/storage/{{ $perfil->imagen }}" class="rounded perfil" alt="imagen chef">
                    @endif
                
                    <h3 class="text-center mt-3 mb-3 text-primary">{{ $perfil->usuario->name_apellido }}</h3>            
                    {!! $perfil->biografia !!}  
                </div>                
            </div>
        </div>
        <div>
        <h5 class="text-center my-4 mb-4">Recetas Creadas por:  <mark>{{ $perfil->usuario->name_apellido }} </h5>
        </div>

        <div class="container">
            <div class="row mx-auto bg-white ">
                @if( count($recetas) > 0)
                    @foreach($recetas as $receta)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="/storage/{{ $receta->imagen }}" class="card-img-top"  alt="imagen receta">
                                
                                <div class="card-body">
                                    <h4>{{ $receta->titulo }}</h4>
                                    <p> {{ count( $receta->likes ) }} Les gustó</p> 
                                    {{-- Div vacio solo para alienar el boton ver --}}
                                    <div class="vacio" style="display:flex; flex-grow:1;"></div>
                                    <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-primary d-block mt-3 font-weight-normal ">Ver Receta</a>
                                </div>                     
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center w-100 font-weight-normal">Este usuario no tiene recetas todavia...</p>
                @endif           
            </div>
            <div class="d-flex justify-content-center">
                {{ $recetas->links() }}
            </div>
        </div>
    </div>
@endsection
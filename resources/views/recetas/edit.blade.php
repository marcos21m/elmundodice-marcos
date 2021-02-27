@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index')}}"
    class="btn btn-primary mr-2 text-white">Administrar Recetas
    </a>

@endsection

@section('content')
    <h3 class="text-center mb-5">Receta a editar : {{$receta->titulo}} </h3>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <form method="POST" action="{{ route('recetas.update', ['receta' => $receta->id]) }}" enctype="multipart/form-data" novallidate>
                @csrf

                @method('PUT')

                <div class="form-group">
                    <label for="titulo">Titulo de la Receta</label>

                    <input type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror "
                        id="titulo"
                        placeholder="Ingrese el titulo de la Receta"
                        value="{{ $receta->titulo }}"
                    >

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group">
                    <label for="categoria">Categoria</label>

                    <select
                        name="categoria"
                        class="form-control @error('categoria') is-invalid @enderror"
                        id="categoria"
                    >
                        <option value="">-- Elija una Categoría --</option>
                        @foreach ($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : ''}}
                            > {{$categoria->nombre}} </option>                                                    
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group mt-3">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{ $receta->ingredientes }}">
                    <trix-editor 
                        class="trix-content @error('ingredientes') is-invalid @enderror"
                        input="ingredientes"
                    ></trix-editor>

                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group mt-3">
                    <label for="preparacion">Preparación</label>
                    <input id="preparacion" type="hidden" name="preparacion" value="{{ $receta->preparacion }}">
                    <trix-editor 
                        class="trix-content @error('preparacion') is-invalid @enderror"
                        input="preparacion"
                    ></trix-editor>
                    
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group mt-3">
                    <label for="imagen">Subir Imagen (maximo 1 mega)</label>
                    
                    <input
                        id="imagen"
                        type="file"
                        class="form-control"
                        name="imagen"
                        value="1024"                    
                    >
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror  
                    
                    <div class="mt-4 mb-3">
                        <p>Imagen Actual: <p>
                        <img src="/storage/{{$receta->imagen}}" style="width: 200px">
                    </div>                
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Publicar Receta">
                </div>
            </form>
        </div>
    </div> 
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
    
    <script
    
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
    
    
@endsection
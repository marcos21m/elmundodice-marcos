@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index')}}"
    class="btn btn-primary mr-2 text-white">
    <svg class="icono-administrar" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
    Volver
    </a>

@endsection

@section('content')
    <h2 class="text-center mb-5">Crear tu receta</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <form method="POST" action="{{ route('recetas.store')}}" enctype="multipart/form-data" novallidate>
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo de la Receta</label>

                    <input type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror "
                        id="titulo"
                        placeholder="Ingrese el titulo de la Receta"
                        value={{ old('titulo')}}
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
                        <option value="">-- Elija una Categoria --</option>
                        @foreach ($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ old('categoria') == $categoria->id ? 'selected' : ''}}
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
                    <label for="ingredientes">Ingredientes:</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{ old('ingredientes') }}">
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
                    <label for="preparacion">Preparación:</label>
                    <input id="preparacion" type="hidden" name="preparacion" value="{{ old('preparacion') }}">
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

                <div class="from-group mt-3 mb-3">
                    
                    <label for="imagen">Subir Imagen (maximo 1 mega)</label>

                    <input
                        id="imagen"
                        type="file"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                        value="1024"
                    >
                    
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
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
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
@endsection
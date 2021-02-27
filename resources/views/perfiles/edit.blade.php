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
    {{-- {{ $perfil }} --}}
    <h2 class="text-center">Editar Mi perfil</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form
                action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')                

                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>

                    <input type="text"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror "
                        id="nombre"
                        placeholder="Cambia tu Nombre/Apellido o usa un alias"
                        value="{{ $perfil->usuario->name_apellido }}"
                    >

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group mt-3">
                    <label for="biografia">Biografia</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}">
                    <trix-editor 
                        class="trix-content @error('biografia') is-invalid @enderror"
                        input="biografia"
                    ></trix-editor>

                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="from-group mt-3">
                    <label for="imagen">Tu Imagen</label>
                    
                    <input
                        id="imagen"
                        type="file"
                        size="1024"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                        value="1024"
                    >
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror  
                    {{-- Usamos if para decir si hay imagen la muestre --}}
                    @if( $perfil->imagen )
                        <div class="mt-4">
                            <p>Imagen Actual: <p>
                           <img src="/storage/{{$perfil->imagen}}" style="width: 200px">
                        </div>
                    @endif                  
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
@endsection
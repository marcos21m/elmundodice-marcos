@extends('layouts.app')

@section('botones')
   @include('ui.navegacion')

@endsection

@section('styles')
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="col-md-12 col-sm-8 mx-auto p-3 bg-white">
        <h3 class="text-center mb-5"><mark>Administra tus recetas</h3>
        <table class="table-sm table-responsive mr-1 mb-2  shadow-lg" style="width: 100%;border: 1px solid #000;" id="recetas">
            <thead class="title bg-primary text-black w-100" styel="border: 1px solid #000;">
                <tr>
                    <th scole="col"><h5>Titulo ↨</h5></th>
                    <th scole="col"><h5>Categoria ↨</h5></th>
                    <th scole="col"><h5>Acciones</h5></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                    <tr>
                        <td>{{$receta->titulo}}</td>
                        <td>{{$receta->categoria->nombre}}</td>
                        <td>
                            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" 
                                class="btn btn-success d-block mb-2">Ver</a>
                            
                            <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" 
                            class="btn btn-dark d-block mb-2">Editar</a>
                                                
                            <eliminar-receta
                                receta-id={{$receta->id}}
                            ></eliminar-receta>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    
            @section('scripts')
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $.noConflict();
                        $('#recetas').DataTable({
                            autoWidth:false,
                        });
                    } );
                </script>
        		@endsection 
        </table> 
        {{-- Bloqueado porque no usamos el paginate de laravel sino de data table
        <div class="col-12 mt-4 justify-content-center d-flex">
        {{ $recetas->links() }}  
        </div>
        --}}
    </div>
@endsection





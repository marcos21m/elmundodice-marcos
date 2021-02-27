@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.index')}}"
    class="btn btn-primary mr-2 text-white">
    <svg class="icono-administrar" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
    Volver
    </a>
@endsection

@section('styles')
<link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="col-md-12 mx-auto bg-white p-2 shadow-lg ml-5 mr-5">
        <h4 class="text-center mb-4 mt-4"><mark>Recetas que te Gustaron</h4>
        <table id="megusta" class="table table-striped table-responsive-md shadow-sm">
            <thead class="bg-primary text-black">
               <tr>
                  <th scope="col"><h5>Titulo ↨</h5></th>
                  <th scope="col"><h5>Categoria ↨</h5></th>
                  <th scope="col"><h5>Acciones</h5></th>
               </tr>
            </thead>
            <tbody>
               @foreach( $usuario->meGusta as $receta )
                  <tr>
                     <td>{{$receta->titulo}}</td>
                     <td>{{$receta->categoria->nombre}}</td>
                     <td>
                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success mr-1  mb-2">Ver</a>    
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
                        $('#megusta').DataTable({
                            autoWidth:false,
                        });
                    } );
                </script>
        		@endsection  
        </table> 
    </div>
@endsection
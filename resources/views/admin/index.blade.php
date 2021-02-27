@extends('layouts.app')

@section('botones')
   

@endsection



@section('content')
<div class="col-12 p-3 bg-white">
    <h3 class="text-center mb-5"><mark>Usuarios</h3>
    <table class="table-responsive mr-1 mb-2  shadow-lg" style="border: 1px solid #000;" id="recetas">
        <thead class="title bg-primary text-black w-100" styel="border: 1px solid #000;">
            <tr>
                <th scole="col"><h5>ID ↨</h5></th>
                <th scole="col"><h5>Nombre y Apellido ↨</h5></th>
                <th scole="col"><h5>Email</h5></th>
                <th scole="col"><h5>Acciones</h5></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id}}</td>
                    <td>{{ $user->name_apellido}}</td>
                    <td class="responsive">{{ $user->email}}</td>
                    <td>
                        
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
</div>
@endsection


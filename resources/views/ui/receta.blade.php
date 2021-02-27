<div class="col-xl-4 col-md-4 col-sm-4 mt-3">
    <div class="card shadow h-100">
        <img class="card-img-top" src="/storage/{{ $receta->imagen }}" alt="imagen receta">
        <div class="card-body h-75">
            <h4 class="card-title">{{$receta->titulo}}</h4>

            <div class="meta-receta text-danger font-weight-bold d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at
                @endphp

                <p class="text-danger fecha font-weight-bold">
                    @php
                        $fecha = $receta->created_at
                    @endphp
                    {{ $fecha->format(' d/m/Y') }}
                </p>
                <span> {{ count( $receta->likes ) }} Me Gusta</span> 
            </div>

                <p>
                    <span class="font-weight-bold text-primary">Autor: </span>
                    <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $receta->autor->id ]) }}">
                        <mark> {{$receta->autor->name_apellido}}
                    </a>
                </p>

            <p> {{ Purify::clean($replaced = str_ireplace($codigoEliminar, [' '], 
                Str::words( strip_tags( $receta->preparacion ), 16)) ) }} </p>
            <div class="vacio" style="display:flex; flex-grow:1;"></div>
            <div class="boton">
            <a href="{{ route('recetas.show', ['receta' => $receta->id ])}}"
                class="boton btn btn-primary d-block btn-receta">Ver Receta
            </a>
            </div>
        </div>
    </div>
</div>

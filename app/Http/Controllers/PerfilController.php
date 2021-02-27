<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    // Protejer nuestro controlador
    public function __construct()
    {
        $this->middleware('chef', ['except' => 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginacion y modelo
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(9);
        
        return view('perfiles.show', compact('perfil', 'recetas') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        // Ejecutar el Policy
        $this->authorize('view', $perfil);
        
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        // Ejecutar el Policy
        $this->authorize('update', $perfil);

        // Validar
        $data = request()->validate ([
            'nombre' => 'required|min:5|max:30',
            'biografia' => ['required', 'min:3', 'max:1200'],
            'imagen' => 'image|max:1024',
        ]);
         // Si el usuario subio una imagen
         if( $request['imagen'] ) {
            // Obtener ruta de imagen
            $ruta_imagen = $request['imagen']->store('imagen-perfil', 'public');
        
            // Establecer tamaño imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Eliminamos imagen Anterior
            Storage::delete('public/' .$perfil->imagen);
            
            // Guardamos imagen nueva
            $img->save();

            // Crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        // Agignar nombre y apelldio
        auth()->user()->name_apellido = $data['nombre'];
        //actualizamos con la funcion
        auth()->user()->save();

        // Una vez guardado los datos del input del formulario debemos borrar para no insertar esa info a Perfil
        unset($data['nombre']);
        
        // Llamamos a la Constante Eliminar codigos del controlador Receta
        $codigoEliminar = RecetaController::CodigoEliminar;

        // Eliminamos los codigos, reemplazandolos por nada de la funcion $data (que guarda los datos del perfil)
        $datas = str_ireplace($codigoEliminar, ' ', $data);

        // Guardar informacion
        //Asignar Biografia e imagen
        auth()->user()->perfil()->update( array_merge(
            $datas,
            $array_imagen ?? []
        ) );


        //redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}

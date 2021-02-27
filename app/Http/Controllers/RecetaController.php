<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;


class RecetaController extends Controller
{
    // Para mostrar solo al usuario registrado y con rol de chef todo lo que este despues
    public function __construct()
    {
        $this->middleware('chef', ['except' => ['show', 'search']]);
    }

    // Constante para eliminar Codigos
    public const CodigoEliminar = [
            '&nbsp;','{','}','::','dd','mysql', 'sql', 'script', 'scripts',
            'alert', '*',
        ];

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // relacion de usuario y sus recetas con modelo
        // $recetas = auth()->user()->recetas;

        
        // Variable usuario que consulta si el usuario es el mismo logueado
        $usuario = auth()->user();

        // Receta con paginación
        $recetas = Receta::where('user_id', $usuario->id)->get();
        
        return view('recetas.index')
            ->with('recetas',$recetas)
            ->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // traer todos los datos modo consola
        //DB::table('categoria_recetas')->get()->pluck('nombre', 'id')->dd();
        
        // Obtener las categorios (SIN MODELO)
        //$categorias= DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        // Obtener categorias CON MODELO
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        // ahora pasamos las categorias consultadas a la vista
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request['imagen']->store('imagen-recetas', 'public') );
        
        // Validacion
        $data = request()->validate([
            'titulo' => 'required|min:4|max:50|string|',
            'categoria' => 'required',
            'preparacion' => ['required','min:10'],
            'ingredientes' => ['required','min:10'],
            'imagen' => 'required|image|max:1024|mimes:jpg,jpeg,webp,png',
        ]);
    
        // Obtener ruta de imagen
        $ruta_imagen = $request['imagen']->store('imagen-recetas', 'public');
        
        // Establecer tamaño imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->resize(600, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        // Guardando imagen
        $img->save();

        // almacenar en la base de dato (sin modelo)
        //DB::table('recetas')->insert([
        //    'titulo' => $data['titulo'],
        //    'preparacion' => $data['preparacion'],
        //    'ingredientes' => $data['ingredientes'],
        //    'imagen' => $ruta_imagen,
        //    'user_id' => Auth::user()->id,
        //    'categoria_id' => $data['categoria']
        // ]);
        
         // Llamamos a la Constante Eliminar codigos
         $codigoEliminar = RecetaController::CodigoEliminar;
         
        // Almacenar en la Base de Datos CON MODELO
        auth()->user()->recetas()->create([
            'titulo' => str_ireplace($codigoEliminar, ' ', $data['titulo']),
            'preparacion' => str_ireplace($codigoEliminar, ' ', $data['preparacion']),
            'ingredientes' => str_ireplace($codigoEliminar, ' ', $data['ingredientes']),
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);
        
        // REDIRECCIONAR A LA PAGINA ADMINISTRAR
        return redirect()->action('RecetaController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        // Llamamos a la Constante Eliminar codigos
        $codigoEliminar = RecetaController::CodigoEliminar;

        $purifyIngredientes = Purify::clean($receta->ingredientes);
        $purifyPreparacion  = Purify::clean($receta->preparacion);

        $replaceIngredientes = str_ireplace($codigoEliminar, ' ', $purifyIngredientes);
        $replacePreparacion = str_ireplace($codigoEliminar, ' ', $purifyPreparacion);


        // Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false; 

        // Pasa la cantidad de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes', 'replaceIngredientes', 'replacePreparacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //Revisar el policy
        $this->authorize('view', $receta);
        
        // Obtener categorias CON MODELO
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // Revisar el policy
        $this->authorize('update', $receta);

        // Validacion
        $data = request()->validate([
            'titulo' => 'required|min:4|max:50',
            'categoria' => 'required',
            'preparacion' => 'required|min:10',
            'ingredientes' => 'required|min:10', 
            'imagen' => 'image|max:1024',          
        ]);
        
        // Llamamos a la Constante Eliminar codigos
        $codigoEliminar = RecetaController::CodigoEliminar;

        // Asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->preparacion = str_ireplace($codigoEliminar, ' ', $data['preparacion']);
        $receta->preparacion = str_ireplace($codigoEliminar, ' ', $data['ingredientes']);
        $receta->categoria_id = $data['categoria'];

        $receta->save();

        // Si el usuario sube una nueva imagen
        if(request('imagen') && ('imagen < 1024') ) {
            // Obtener ruta de imagen
            $ruta_imagen = $request['imagen']->store('imagen-recetas', 'public');

            // Establecer tamaño imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->resize(600, 500, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Eliminamos imagen Anterior
            Storage::delete('public/' .$receta->imagen);
            
            // Guardamos imagen nueva
            $img->save();
            
            // Asignar al objeto
            $receta->imagen = $ruta_imagen;
        } 

        $receta->save();

        //redireccionar luego de actualizar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */

    public function destroy(Receta $receta)
    {
        // Ejecutar el Policy desde el metodo delete
        $this->authorize('delete', $receta);

        // Eliminar la receta
        if(Storage::delete('public/' .$receta->imagen))
        {
            $receta->delete();
        }
        
        return redirect()->action('RecetaController@index');
    }
    
    public function search(Request $request) 
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        // Llamamos a la Constante Eliminar codigos
        $codigoEliminar = RecetaController::CodigoEliminar;

        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(9);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda', 'codigoEliminar'));
    }
}

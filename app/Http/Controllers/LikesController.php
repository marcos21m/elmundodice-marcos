<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    // Solo usuarios autenticados puede dar me gusta
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Variable usuario que consulta si el usuario es el mismo logueado
        $usuario = auth()->user();

        // Receta con paginación
        $recetas = Receta::where('user_id', $usuario->id)->paginate(8);

        return view('recetas.megusta')
            ->with('recetas',$recetas)
            ->with('usuario', $usuario);
    }


    public function update(Request $request, Receta $receta)
    {
        // Almacena los likes de un usuario a una receta
        //if(auth()->user()) {
            return auth()->user()->meGusta()->toggle($receta);
        //}    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    
}

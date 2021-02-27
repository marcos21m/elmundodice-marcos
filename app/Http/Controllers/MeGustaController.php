<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaReceta;
use App\Receta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class MeGustaController extends Controller
{
    // Para mostrar solo al usuario registrado todo lo que este despues
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    
}

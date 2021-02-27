<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index()
    {
        // Llamamos a la Constante Eliminar codigos
        $codigoEliminar = RecetaController::CodigoEliminar;

        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->orderBy('created_at','desc')->take(15)->paginate(9);
        
        return view('recetas.popular', compact('votadas', 'codigoEliminar' ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaReceta $categoriaReceta)
    {
        $codigoEliminar = [
            '&nbsp;','{','}','::','dd','mysql', 'sql', 'script', 'scripts','*'
        ];

        $recetas = Receta::where('categoria_id', $categoriaReceta->id)->orderBy("created_at", "desc")->paginate(9);

        return view('categorias.show', compact('recetas', 'categoriaReceta', 'codigoEliminar'));
    }
}

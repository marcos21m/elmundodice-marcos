<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    // CAMPOS QUE SE VAN AGREGAR
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id'
    ];
    
    // Obtiene la categoria de la receta via FK
    public function categoria()
    {
        return $this ->belongsTo(CategoriaReceta::class);
    }

    // obtiene la informacion del usuario via FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');  // FK de esta tabla
    }

    // Likes recibido una receta por parte de los usuarios
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
    

}

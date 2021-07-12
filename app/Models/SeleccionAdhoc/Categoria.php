<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table="categorias";

    protected $fillable = [
        'nombre',
        'slug',
    ];
    //items

    public function items()
    {
        return $this->hasMany('App\Models\SeleccionAdhoc\Item','categoria_id');
    }
}

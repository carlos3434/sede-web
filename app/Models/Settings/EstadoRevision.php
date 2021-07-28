<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class EstadoRevision extends Model
{
    const OBSERVADO = 1;
    const ADMITIDO = 2;
    const SUBSANADO = 3;
    protected $table="estado_revision";

}

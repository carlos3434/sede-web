<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\TipoDocumentoFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoDocumento extends Model
{
    use LogsActivity;

    protected $table="tipos_documentos";

    public function scopeFilter(Builder $builder, $request)
    {
        return (new TipoDocumentoFilter($request))->filter($builder);
    }

    protected $fillable = [
        'nombre'
    ];

    /**
     * Obtiene los usuarios del TipoDocumento
     */
    public function usuarios()
    {
        return $this->hasMany('App\Models\Auth\User','tipo_documento_id');
    }
}

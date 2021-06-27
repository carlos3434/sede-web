<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\TipoCapacitacionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoCapacitacion extends Model
{
    use LogsActivity;
    //
    protected $table="tipos_capacitaciones";

    protected $fillable = [
        'nombre'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new TipoCapacitacionFilter($request))->filter($builder);
    }

}

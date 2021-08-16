<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Settings\ItemFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;


class Item extends Model
{
    use LogsActivity;

    protected $table="items";

    protected $fillable = [
        'nombre',
        'puntaje',
        'activo',
        'categoria_id'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ItemFilter($request))->filter($builder);
    }
}

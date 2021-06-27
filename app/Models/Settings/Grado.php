<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\GradoFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Grado extends Model
{
    use LogsActivity;
    //grado academico
    protected $table="grados";

    protected $fillable = [
        'nombre'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new GradoFilter($request))->filter($builder);
    }

}

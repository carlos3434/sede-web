<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\RegistroAdhoc\SedeRegistralFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;


class SedeRegistral extends Model
{
    use LogsActivity;

    protected $table="sedes_registrales";

    protected $fillable = [
        'nombre'
    ];
    public function scopeFilter(Builder $builder, $request)
    {
        return (new SedeRegistralFilter($request))->filter($builder);
    }
}

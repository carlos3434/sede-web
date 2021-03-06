<?php

namespace App\Models\DiligenciaVerificador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Filters\DiligenciaVerificador\DiligenciaFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;


class Diligencia extends Model
{
    use LogsActivity;

    protected $table="diligencias";
    protected $fillable = [
        'fecha',
        'entrega_expediente_id',
        'anexo8',
        'anexo9',
        'anexo10'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new DiligenciaFilter($request))->filter($builder);
    }

    public function entrega()
    {
        return $this->belongsTo('App\Models\RevisionExpediente\EntregaExpediente', 'entrega_expediente_id');
    }
}

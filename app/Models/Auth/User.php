<?php

namespace App\Models\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\Auth\UserFilter;
use Spatie\Permission\Traits\HasRoles;
use App\Models\SeleccionAdhoc\Calificacion;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens;
    use Notifiable;
    use HasRoles;
    //use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'email',
        'password',
        'tipo_documento_id',
        'numero_documento',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'pais_id',
        'distrito_id',
        'telefono_fijo',
        'celular',
        'estado_civil_id',
        'direccion',
        'colegio_profesional',
        'numero_colegiatura',
        'esta_habilitado',
        'profesion',

        'constancia_habilidad',
        'declaracion_jurada',
        'copia_dni',
        'rj_itse',
        'rj_verificador',
        'anexo_1',
        'foto',
    ];

    protected static $logFillable = true;
    //protected static $logUnguarded  = true; $guarded

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('users');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new UserFilter($request))->filter($builder);
    }

    /**
     * Obtiene el pais al que pertenece el usuario
     */
    public function estadoCivil()
    {
        return $this->belongsTo('App\Models\Settings\EstadoCivil', 'estado_civil_id');
    }
    /**
     * Obtiene el pais al que pertenece el usuario
     */
    public function pais()
    {
        return $this->belongsTo('App\Models\Settings\Pais', 'pais_id');
    }


    /**
     * Obtiene el tipo de documento al que pertenece el usuario
     */
    public function tipoDocumento()
    {
        return $this->belongsTo('App\Models\Settings\TipoDocumento', 'tipo_documento_id');
    }

    /**
     * Obtiene el distrito al que pertenece el usuario
     */
    public function distrito()
    {
        return $this->belongsTo('App\Models\Settings\Distrito', 'distrito_id');
    }
    /**
     * Determina si un verificador adhoc esta postulando a una convocatoria 
     * dicha convocatoria esta vigente
     */
    public function scopeEstaPostulando()
    {
        return (bool) Calificacion::from('calificaciones as ca')
        ->join('convocatorias as c', 'ca.convocatoria_id', '=', 'c.id')
        ->where('activo', true)
        ->where('usuario_id',$this->id)
        ->count();
    }
    public function scopeEstaAcreditado()
    {
        return (bool) Calificacion::from('calificaciones as ca')
        ->join('acreditaciones as a', 'ca.id', '=', 'a.calificacion_id')
        ->where('usuario_id',$this->id)
        ->count();
    }

    public function calificaciones()
    {
        return $this->hasMany('App\Models\SeleccionAdhoc\Calificacion','usuario_id');
    }

    public function capacitaciones()
    {
        return $this->hasMany('App\Models\RegistroAdhoc\Capacitacion','usuario_id');
    }

    public function formaciones()
    {
        return $this->hasMany('App\Models\RegistroAdhoc\Formacion','usuario_id');
    }

    public function experienciasGenerales()
    {
        return $this->hasMany('App\Models\RegistroAdhoc\ExperienciaGeneral','usuario_id');
    }

    public function experienciasInspector()
    {
        return $this->hasMany('App\Models\RegistroAdhoc\ExperienciaInspector','usuario_id');
    }

    public function verificacionesRealizadas()
    {
        return $this->hasMany('App\Models\RegistroAdhoc\VerificacionRealizada','usuario_id');
    }
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->apellido_paterno} {$this->apellido_materno} {$this->nombres}";
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailQueued);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordQueued($token));
    }
}

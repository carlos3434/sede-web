<?php

namespace App\Models\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\Auth\UserFilter;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
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
    ];

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

    public function estaPostulando()
    {
        $convocatoriaActual = Configuracion::convocatoriaActual();
        $calificacionInicial= Calificacion::where('usuario_id',$this->id)->where('convocatoria_id',$convocatoriaActual)->count();
        return ($calificacionInicial >0);
    }

    public function estaAcreditado()
    {
        $calificacion = Calificacion::where('usuario_id',$this->id)->get()[0];

        //var_dump($calificacion);
        //die();
        return $calificacion->acreditacion;
    }

    public function capacitaciones()
    {
        return $this->hasMany('App\Capacitacion','usuario_id');
    }

    public function formaciones()
    {
        return $this->hasMany('App\Formacion','usuario_id');
    }

    public function experienciasGenerales()
    {
        return $this->hasMany('App\ExperienciaGeneral','usuario_id');
    }

    public function experienciasInspector()
    {
        return $this->hasMany('App\ExperienciaInspector','usuario_id');
    }

    public function verificacionesRealizadas()
    {
        return $this->hasMany('App\VerificacionRealizada','usuario_id');
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

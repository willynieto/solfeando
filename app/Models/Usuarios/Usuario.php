<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Usuarios;

use Illuminate\Notifications\Notifiable;
use App\Models\Estado;
use App\Notifications\Usuarios\CustomResetPassword;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Usuario
 *
 * @property int $id
 * @property string $nombre_usuario
 * @property string|null $apellido_usuario
 * @property string $postal_usuario
 * @property string $direccion_usuario
 * @property string $telefono_usuario
 * @property string $email
 * @property string $password
 * @property int $pais_id
 * @property int $ciudad_id
 * @property int $rol_id
 * @property int|null $suscripcion_id
 *
 * @property Ciudad $ciudad
 * @property Pais $pais
 * @property Rol $rol
 * @property Suscripcion|null $suscripcion
 * @property Collection|Suscripcion[] $suscripciones
 *
 * @package App\Models
 */
class Usuario extends Authenticatable
{
	protected $table = 'usuarios';
	public $timestamps = true;
    use Notifiable;

	protected $casts = [
		'pais_id' => 'int',
		'ciudad_id' => 'int',
		'rol_id' => 'int',
        'estado_id' => 'int'
	];

	protected $fillable = [
		'nombre_usuario',
		'apellido_usuario',
		'postal_usuario',
		'direccion_usuario',
		'telefono_usuario',
		'email',
		'password',
		'pais_id',
		'ciudad_id',
		'rol_id',
		'suscripcion_id',
        'estado_id'
	];

    protected $hidden = ['password'];

	public function ciudad()
	{
		return $this->belongsTo(Ciudad::class, 'ciudad_id');
	}

	public function pais()
	{
		return $this->belongsTo(Pais::class, 'pais_id');
	}

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'rol_id');
	}

	public function suscripciones()
	{
		return $this->hasMany(Suscripcion::class);
	}

    public function estado()
	{
		return $this->belongsTo(Estado::class, 'estado_id');
	}

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $email = $this->getEmailForPasswordReset();

        $this->notify(new CustomResetPassword($token, $email));
    }
}

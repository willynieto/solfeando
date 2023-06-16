<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Suscripciones;

use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suscripcion
 *
 * @property int $id
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_expiracion
 * @property int $instrumento_id
 * @property int $suscripcion_id
 *
 * @property Estado $estado
 *
 * @package App\Models
 */
class Suscripcion extends Model
{
	protected $table = 'suscripciones';
	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_expiracion' => 'datetime',
		'instrumento_id' => 'int',
		'usuario_id' => 'int',
        'estado_id' => 'int',
        'metodo_pago_id' => 'int'
	];

	protected $fillable = [
		'fecha_inicio',
		'fecha_expiracion',
		'instrumento_id',
        'numero_operacion_pago',
		'usuario_id',
        'estado_id',
        'metodo_pago_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

    public function estado()
    {
        return $this->hasOne(Estado::class);
    }

    public function metodos_pago()
	{
		return $this->belongsTo(MetodosPago::class, 'metodo_pago_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\MetodosPago;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MetodoPago
 *
 * @property int $id
 * @property string $medio_pago
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Suscripcione[] $suscripciones
 *
 * @package App\Models
 */
class MetodoPago extends Model
{
	protected $table = 'metodos_pago';

    public $timestamps = true;

	protected $fillable = [
		'medio_pago'
	];

	public function suscripciones()
	{
		return $this->hasMany(Suscripcione::class, 'metodo_pago_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Instrumentos;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instrumento
 *
 * @property int $id
 * @property string $nombre_instrumento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Suscripcione[] $suscripciones
 *
 * @package App\Models
 */
class Instrumento extends Model
{
	protected $table = 'instrumentos';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nombre_instrumento'
	];

	public function suscripciones()
	{
		return $this->hasMany(Suscripcione::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Ciudades;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ciudad
 *
 * @property int $id
 * @property string $nombre_ciudad
 * @property int $pais_id
 *
 * @property Pais $pais
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Ciudad extends Model
{
	protected $table = 'ciudades';
	public $timestamps = true;

	protected $casts = [
		'id' => 'int',
		'pais_id' => 'int'
	];

	protected $fillable = [
		'nombre_ciudad',
		'pais_id'
	];

	public function pais()
	{
		return $this->belongsTo(Pais::class, 'pais_id');
	}

	public function usuario()
	{
		return $this->hasMany(Usuario::class, 'ciudad_id');
	}
}

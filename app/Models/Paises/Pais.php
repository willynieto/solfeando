<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Paises;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pais
 *
 * @property int $id
 * @property string $nombre_pais
 *
 * @property Collection|Ciudad[] $ciudades
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Pais extends Model
{
	protected $table = 'paises';
	public $timestamps = true;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nombre_pais'
	];

	public function ciudades()
	{
		return $this->hasMany(Ciudad::class, 'pais_id');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'pais_id');
	}
}

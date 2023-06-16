<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rol
 *
 * @property int $id
 * @property string $nombre_rol
 *
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Rol extends Model
{
	protected $table = 'roles';
	public $timestamps = true;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nombre_rol'
	];

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'rol_id');
	}
}

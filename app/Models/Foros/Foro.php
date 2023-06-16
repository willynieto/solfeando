<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Foros;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Foro
 *
 * @property int $id
 * @property string $asunto
 * @property string $contenido
 * @property int $usuario_id
 *
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Foro extends Model
{
	protected $table = 'foros';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'asunto',
		'contenido',
		'usuario_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}

<?php

namespace App\Models\Estados;

use App\Models\Suscripciones\Suscripcion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
	public $timestamps = true;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nombre_estado'
	];

	public function usuario()
	{
		return $this->hasMany(Usuario::class);
	}

    public function suscripcion()
    {
        return $this->hasMany(Suscripcion::class);
    }
}

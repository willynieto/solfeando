<?php

namespace App\Models\Instrumentos\Validaciones;

use Illuminate\Http\Request;

class InstrumentosVal {

    public function validacionInstrumento(Request $request)
    {
        $request->validate([
            'nombre_instrumento' => 'required|string|max:15',
        ]);
    }

}

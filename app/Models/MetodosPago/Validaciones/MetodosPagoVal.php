<?php

namespace App\Models\MetodosPago\Validaciones;

use Illuminate\Http\Request;

class MetodosPagoVal {

    public function validacionMetodosPago(Request $request)
    {
        $request->validate([
            'medio_pago' => 'required|max:35',
        ]);
    }

}
